<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosManageVueController extends Controller
{
    public function index()
    {
        return view('videos.manage.vue.index');
    }
}
