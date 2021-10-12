<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        //Is as SELECT * From anime
        $anime = Anime::all();

        return view('anime', compact('anime'));
    }

    /**
     * Display Admin Page.
     *
     */
    public function admin(){

        $animes = Anime::all();
        return view('admin/overview', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin/addAnime');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $anime = new Anime;
        $anime->title = $request->input('title');
        $anime->description = $request->input('description');
        $anime->genre_id = $request->input('genre_id');
        $anime->language_id = $request->input('language_id');
        $anime->seasons = $request->input('seasons');
        $anime->episodes = $request->input('episodes');
        $anime->users_favorite = $request->input('users_favorite');
        $anime->rating = $request->input('rating');
        $anime->year = $request->input('year');
        $anime->comment_id = $request->input('comment_id');
        $anime->image_card = $request->input('image_card');
        $anime->image_show = $request->input('image_show');
        $anime->status = $request->input('status');

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Anime $anime
     * @return Application|Factory|View|Response
     */
    public function show(Request $request, Anime $anime)
    {
        return view('anime', compact('anime'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $anime = Anime::find($id);
        return view('admin/edit', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, $id)
    {
        $anime = Anime::find($id);

        $anime->title = $request->input('title');
        $anime->description = $request->input('description');
        $anime->genre_id = $request->input('title');
        $anime->language_id = $request->input('title');
        $anime->seasons = $request->input('title');
        $anime->episodes = $request->input('title');
        $anime->users_favorite = $request->input('title');
        $anime->rating = $request->input('title');
        $anime->year = $request->input('title');
        $anime->comment_id = $request->input('title');
        $anime->image_card = $request->input('title');
        $anime->image_show = $request->input('title');
        $anime->status = $request->input('title');

        $anime->save();
        return redirect()->back()->with('status', "Anime Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $anime = Anime::find($id);
        $anime->delete();
        return redirect()->back()->with('status', 'Anime Deleted');
    }
}
