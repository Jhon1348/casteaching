<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideoTest;

class VideosController extends Controller
{
    public function testBy()
    {
        return VideoTest::class;
    }

    public function show($id)
    {
        return view('videos.show',[
            'video' =>Video::findOrFail($id)
        ]); //CRED -> RETRIEVE -> nomes un video
    }
}
