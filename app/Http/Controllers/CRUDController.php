<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\CRUD;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     *
     */
    public function index()
    {
        $animes = Anime::all();

        return view('admin/overview', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return Response
     */
    public function show(CRUD $cRUD)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return Response
     */
    public function edit(CRUD $cRUD)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CRUD  $cRUD
     * @return Response
     */
    public function update(Request $request, CRUD $cRUD)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRUD  $cRUD
     * @return Response
     */
    public function destroy(CRUD $cRUD)
    {
        //
    }
}