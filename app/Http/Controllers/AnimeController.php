<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
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
        $animes = Anime::all();
        $genres = Genre::all();
        return view('anime', compact('animes', 'genres'));
    }

    /**
     * Display Admin Page.
     *
     */
    public function admin(){

        $animes = Anime::all();
        $genres = Genre::all();
        return view('admin/overview', compact('animes', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin/addAnime', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $anime = new Anime;
        $anime->title = $request->input('title');
        $anime->description = $request->input('description');
        $anime->episodes = $request->input('episodes');
        $anime->rating = $request->input('rating');
        $anime->year = $request->input('season') . " " . $request->input('year');
        $anime->image_card = $request->input('image_card');
        $anime->image_show = $request->input('image_show');

        $anime->image_card = $request->file('image_card')->storePublicly('images', 'public');
        $anime->image_show = $request->file('image_show')->storePublicly('images', 'public');
        $anime->image_card = str_replace('images/', '', $anime->image_card);
        $anime->image_show = str_replace('images/', '', $anime->image_show);

        $anime->status = $request->input('status');
        $anime->save();
        $anime->genres()->attach($request->input('genre_id'));
        return redirect()->route('admin')->with('status', 'Anime Added Successfully');

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
    public function edit(Anime $anime)
    {
        $anime = Anime::find($anime->id);
        $genres = Genre::all();
//        dd($anime);
        return view('admin/edit', compact('anime', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Anime $anime
     * @return RedirectResponse|Response
     */
    public function update(Request $request, Anime $anime)
    {
        $anime = Anime::find($anime->id);

        $anime->title = $request->input('title');
        $anime->description = $request->input('description');
        $anime->episodes = $request->input('episodes');
        $anime->rating = $request->input('rating');
        $anime->year = $request->input('season') . " " . $request->input('year');
        $anime->image_card = $request->input('image_card');
        $anime->image_show = $request->input('image_show');

        $anime->save();
        return redirect()->back()->with('status', "Anime Updated");
    }

    /**
     * Remove the specified resource from storage.
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function destroy(Anime $anime)
    {
        $anime->genres()->detach();
        $anime->delete();
        return redirect()->back()->with('status', 'Anime Deleted');
    }
}
