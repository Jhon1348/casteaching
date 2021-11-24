<?php

namespace Tests\Unit;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function isSuperAdmin()
    {
        $user = User::create([
            'name'=>'SuperAmin',
            'email'=>'superadmin@casteaching.com',
            'password'=> Hash::make('12345678')
        ]);
        $user->superadmin = true;
        $user->save();
        $this->assertEquals($user->isSuperAdmin(),true);
    }
}
