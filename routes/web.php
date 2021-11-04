<?php

use App\Http\Controllers\VideosController;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos/{id}', [VideosController::class, 'show']);


//Route::get('/videos/1', function () {
////    return 'Ubuntu 101 | Here description | December 13';
//    $video = Video::find(1);
////    dd($video->title);
////    $video = new stdClass();
////    $video->title = 'Ubuntu 101';
////    $video->description = 'Here description';
////    $video->published_at ='December 13';
//    return view('videos.show',[
//        'video' =>$video
//    ]); //CRED -> RETRIEVE -> nomes un video
//});
