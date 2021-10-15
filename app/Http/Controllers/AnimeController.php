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
use function Sodium\compare;

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
        $animeGenres = $request->input('genre_id');

//        Check if Title has been filled other wise skip this part of the edit
        if (!$request->input('title') == "") {
            $anime->title = $request->input('title');
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime title must be filled in');
        }

//        Check if Description has been filled other wise skip this part of the edit
        if (!$request->input('description') == "") {
            $anime->description = $request->input('description');
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime description must be filled in');
        }

//        Check if Episodes has been filled other wise skip this part of the edit
        if (!$request->input('episodes') == "") {
            $anime->episodes = $request->input('episodes');
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime episodes must be filled in');
        }

//        Check if Rating has been filled other wise skip this part of the edit
        if (!$request->input('rating') == "") {
            $anime->rating = $request->input('rating');
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime rating must be filled in');
        }

//        Check if Season & Year has been filled other wise skip this part of the edit
        if (!$request->input('season') == "" && !$request->input('year') == "" || $request->input('season') == "" || !$request->input('year') == "") {
            $anime->year = $request->input('season'). " " . $request->input('year');
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime premiere season and year must be filled in');
        }

//        Check if Image_card has been added other wise skip this part of the edit
        if (!$request->file('image_card') == ""){
            $anime->image_card = $request->file('image_card')->storePublicly('images', 'public');
            $anime->image_card = str_replace('images/', '', $anime->image_card);
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime image card must be uploaded');
        }
//        Check if Image_show has been added other wise skip this part of the edit
        if (!$request->file('image_show') == ""){
            $anime->image_show = $request->file('image_show')->storePublicly('images', 'public');
            $anime->image_show = str_replace('images/', '', $anime->image_show);
        }else{
            return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime image show must be uploaded');
        }


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
//        dd(substr($anime->year, -4) . "\n" . substr($anime->year, 0, -5));
        $animeGenres =  $anime->genres()->get();
        $anime = Anime::find($anime->id);
        $genres = Genre::all();

//        dd($anime);
        return view('admin/edit', compact('anime', 'genres', 'animeGenres'));
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

//        Check if Title has been filled other wise skip this part of the edit
        if (!$request->input('title') == "") {
            $anime->title = $request->input('title');
        }

//        Check if Description has been filled other wise skip this part of the edit
        if (!$request->input('description') == "") {
            $anime->description = $request->input('description');
        }

//        Check if Episodes has been filled other wise skip this part of the edit
        if (!$request->input('episodes') == "") {
            $anime->episodes = $request->input('episodes');
        }

//        Check if Rating has been filled other wise skip this part of the edit
        if (!$request->input('rating') == "") {
            $anime->rating = $request->input('rating');
        }

//        Check if Season & Year has been filled other wise skip this part of the edit
        if (!$request->input('season') == "" && !$request->input('year') == "") {
            $anime->year = $request->input('season'). " " . $request->input('year');
        }
//        Check if Season has been filled other wise skip this part of the edit
        elseif (!$request->input('season') == "" ) {
            $anime->year = $request->input('season'). " " . substr($anime->year, -4);
        }
//        Check if Year has been filled other wise skip this part of the edit
        elseif (!$request->input('year') == ""){
            $anime->year = substr($anime->year, 0, -5) . " " . $request->input('year');
        }

//        Check if Image_card has been added other wise skip this part of the edit
        if (!$request->file('image_card') == ""){
            $anime->image_card = $request->file('image_card')->storePublicly('images', 'public');
            $anime->image_card = str_replace('images/', '', $anime->image_card);
        }
//        Check if Image_show has been added other wise skip this part of the edit
        if (!$request->file('image_show') == ""){
            $anime->image_show = $request->file('image_show')->storePublicly('images', 'public');
            $anime->image_show = str_replace('images/', '', $anime->image_show);
        }
//        save data
        $anime->save();
//        Detach past relations with genre
        $anime->genres()->detach();
//        Attach new relations with genre
        $anime->genres()->attach($request->input('genre_id'));
//        Redirect back to admin with status
        return redirect()->route('admin')->with('status', "Anime Updated");
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
