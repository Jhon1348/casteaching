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
     * Create mostra el formulari de creació
     */
    public function create()
    {
        //
    }

    /**
     * Guarda a la base de dades el nou video
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}