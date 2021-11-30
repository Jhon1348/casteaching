<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public function testeBy()
    {
        return VideosManageControllerTest::class;
    }
    /**
     * Retrieve llista
     */
    public function index()
    {
        return view('videos.manage.index',[
            'videos' => Video::all()
        ]);
    }

    /**
     * Guarda a la base de dades el nou video
     */
    public function store(Request $request)
    {
//        return response()-> view('videos.manage.index',['videos'=> []], 201);
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url
        ]);

        session()->flash('status','Successfully created');
        return redirect()->route('manage.videos');
    }

    /**
     * R-> Individual
     */
    public function show($id)
    {
        //
    }

    /**
     * Update ->formulari
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update -> processarà el formulari i guardara las modificacions
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('status','Successfully removed');
        return redirect()->route('manage.videos');
    }
}
