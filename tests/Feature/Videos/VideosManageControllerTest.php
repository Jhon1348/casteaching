<?php

namespace Tests\Feature\Videos;

use App\Events\VideoCreated;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

/**
 * @covers \App\Http\Controllers\VideosManageController
 */

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function user_with_permissions_can_update_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();
        $video = Video::create([
            'title' => 'Nou video',
            'description' => 'Reacció serie',
            'url' => 'https://youtu.be/3VS973ZUys8'
        ]);

        $response = $this->put('/manage/videos/'. $video->id,[
            'title' => 'All Good Things',
            'description' => 'Hold On',
            'url' => 'https://youtu.be/I8ow3RbVEoQ'
            ]);

        $response->assertRedirect(route('manage.videos'));
//        $response->assertViewIS('videos.manage.index');
        $response->assertSessionHas('status','Successfully updated');

        $newVideo =Video::find($video->id);
        $this->assertEquals('All Good Things',$newVideo->title);
        $this->assertEquals('Hold On',$newVideo->description);
        $this->assertEquals('https://youtu.be/I8ow3RbVEoQ',$newVideo->url);
        $this->assertEquals($video->id, $newVideo->id);

    }

    /**
     * @test
     */
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create([
            'title' => 'Nou video',
            'description' => 'Reacció serie',
            'url' => 'https://youtu.be/3VS973ZUys8'
        ]);

        $response = $this->get('/manage/videos/'. $video->id);

        $response->assertStatus(200);
        $response->assertViewIS('videos.manage.edit');
        $response->assertViewHas('video', function ($v) use ($video){

            return $video->is($v);
        });

        $response->assertSee('<form data-qa="form_video_edit"',false);

        $response->assertSeeText($video->title);
        $response->assertSeeText($video->description);
        $response->assertSee($video->url);

    }

    /**
     * @test
     */
    public function user_with_permissions_can_destroy_videos()
    {
        //fase 1
        $this->loginAsVideoManager();
        $video = Video::create([
            'title' => 'Nou video',
            'description' => 'Reacció serie',
            'url' => 'https://youtu.be/3VS973ZUys8'
        ]);

            //crear un video
        $response = $this->delete('/manage/videos/'. $video->id);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully removed');
        $this->assertNull(Video::find($video->id));
        $this->assertNull($video->fresh());
    }
    /**
     * @test
     */
    public function user_without_permissions_cannot_destroy_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::create([
            'title' => 'Nou video',
            'description' => 'Reacció serie',
            'url' => 'https://youtu.be/3VS973ZUys8'
        ]);

        $response = $this->delete('/manage/videos/'. $video->id);

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function user_with_permissions_can_store_videos()
    {
//        $this-> withoutExceptionHandling();
        $this->loginAsVideoManager();
        $video = objectify ($videoArray=[
            'title' => 'Nou video',
            'description' => 'Reacció serie',
            'url' => 'https://youtu.be/3VS973ZUys8'
        ]);

        Event::fake();

        $response = $this->post('/manage/videos',$videoArray);

        Event::assertDispatched(VideoCreated::class);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully created');


        //3 asserting
        $videoDB = Video::first();
        $this->assertNotNull($videoDB);
        $this->assertEquals($videoDB-> title,$video->title);
        $this->assertEquals($videoDB-> description,$video->description);
        $this->assertEquals($videoDB-> url,$video->url);
        $this->assertNull($videoDB->published_at);
    }


    /**
     * @test
     */
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIS('videos.manage.index');

        $response->assertSee('<form data-qa="form_video_create"',false);
    }
    /** @test  */
    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        $user = User::create([
            'name' => 'Pepe',
            'email' => 'Pepe',
            'password' => Hash::make('12345678')
        ]);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);

        Auth::login($user);

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertDontSee('<form data-qa="form_video_create"',false);
    }


    /**
     * @test
     */
    public function user_with_permissions_can_manage_videos()
    {
        //1
        $this->loginAsVideoManager();

        $videos =create_sample_videos();

        //2 executar
        $response = $this->get('/manage/videos');

        //3 provar
        $response->assertStatus(200);
        $response->assertViewIS('videos.manage.index');
        $response->assertViewHas('videos', function ($v)use ($videos){
            return $v->count() === count($videos) && get_class($v)
                ===Collection::class && get_class($videos[0]) ===Video::class;
        });

        foreach ($videos as $video) {
            $response ->assertSee($video ->id);
            $response ->assertSee($video ->title);
//            $response ->assertSee($video ->title);
        }

    }

    /**
     * @test
     */
    public function regular_users_cannot_manage_videos()
    {
        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function guest_users_cannot_manage_videos()
    {
        $response = $this->get('/manage/videos');
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function superadmins_can_manage_videos()
    {
        //1
        $this->loginAsSuperAdmin();

        //2 executar
        $response = $this->get('/manage/videos');

        //3 provar
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }

}
