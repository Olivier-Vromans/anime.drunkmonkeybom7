<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\User;
use DebugBar\DebugBar;
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
//        dd(request('genre'));
        return view('anime', [
            'animes' => Anime::latest()->filter(request(['search', 'genre']))->get()->sortBy('id'),
            'genres' => Genre::all(),
            'currentGenre' => Genre::firstWhere('id', request('genre')),
            'user' => User::find(auth()->id())
        ]);
    }

    /**
     * Display Admin Page.
     *
     */
    public function admin(){
        if (auth()->user()->role === 1){
            $animes = Anime::all();
            $genres = Genre::all();
            $user = User::find(auth()->id());
            return view('admin/overview', compact('animes', 'genres', 'user'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        if (auth()->user()->role === 1) {
            $genres = Genre::all();
            $user = User::find(auth()->id());
            return view('admin/addAnime', compact('genres', 'user'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 1){
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
                $anime->image_card = str_replace('images/image_card', '', $anime->image_card);
            }else{
                return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime image card must be uploaded');
            }
            //        Check if Image_show has been added other wise skip this part of the edit
            if (!$request->file('image_show') == ""){
                $anime->image_show = $request->file('image_show')->storePublicly('images', 'public');
                $anime->image_show = str_replace('images/image_show', '', $anime->image_show);
            }else{
                return redirect()->back()->with(compact('anime', 'animeGenres'))->with('danger', 'Anime image show must be uploaded');
            }


            $anime->status = $request->input('status');
            $anime->save();
            $anime->genres()->attach($request->input('genre_id'));
            return redirect()->route('admin')->with('status', 'Anime Added Successfully');
        }else{
            return redirect('/');
        }
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
        $genres = Genre::all();
        $user = User::find(auth()->id());
        return view('detail', compact('anime', 'genres', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Genre $genres
     * @return Application|Factory|View|Response
     */
    public function showGenre(Request $request, Genre $genres)
    {
        $genres = Genre::all();

        return view('anime', compact('anime', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return Application|Factory|View|Response
     */
    public function edit(Anime $anime)
    {
        if (auth()->user()->role === 1){
            $animeGenres =  $anime->genres()->get();
            $anime = Anime::find($anime->id);
            $genres = Genre::all();
            $user = User::find(auth()->id());

            return view('admin/edit', compact('anime', 'genres', 'animeGenres', 'user'));
        }else{
            return redirect('/');
        }
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
        if (auth()->user()->role === 1){
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
                $anime->image_card = str_replace('images/image_card', '', $anime->image_card);
            }
            //        Check if Image_show has been added other wise skip this part of the edit
            if (!$request->file('image_show') == ""){
                $anime->image_show = $request->file('image_show')->storePublicly('images', 'public');
                $anime->image_show = str_replace('images/image_show', '', $anime->image_show);
            }
            //        save data
            $anime->save();
            //        Detach past relations with genre
            $anime->genres()->detach();
            //        Attach new relations with genre
            $anime->genres()->attach($request->input('genre_id'));
            //        Redirect back to admin with status
            return redirect()->route('admin')->with('status', "Anime Updated");
        }else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function destroy(Anime $anime)
    {
        if (auth()->user()->role === 1){
            $anime->genres()->detach();
            $anime->delete();
            return redirect()->back()->with('status', 'Anime Deleted');
        }else{
            return redirect('/');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function favorite(Request $request, Anime $anime)
    {
        $user = User::find(auth()->id());
        $anime = Anime::find($request->input('id'));
        $anime->save();
        $anime->user()->attach($user);
        return redirect()->back()->with('status', 'Anime Favorited');
    }

    /**
     * delete favorite in storage.
     *
     * @param Request $request
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function unFavorite(Request $request, Anime $anime)
    {
        $user = User::find(auth()->id());
        $anime = Anime::find($request->input('id'));
        $anime->save();
        $anime->user()->detach($user);
        return redirect()->back()->with('status', 'Anime Unfavorited');
    }
    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $anime = Anime::findOrFail($request->anime_id);
        $anime->status = $request->status;
        $anime->save();

        return response()->json(['status' => 'Anime status updated successfully.']);
    }
}
