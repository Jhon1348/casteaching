<?php

use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos/{id}', [VideosController::class, 'show']);


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/manage/videos', [VideosManageController::class, 'index'])->middleware(['can:videos_manage_index'])
        ->name('manage.videos');

    Route::post('/manage/videos', [VideosManageController::class, 'store']);

    Route::get('/manage/users', [ \App\Http\Controllers\UsersManageController::class,'index'])->middleware(['can:users_manage_index'])
        ->name('manage.users');
});
