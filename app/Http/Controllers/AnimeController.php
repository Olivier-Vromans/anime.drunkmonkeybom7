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
        return view('anime', [
            //Get all anime and if there is a filter or search get only those
            'animes' => Anime::latest()->filter(request(['search', 'genre']))->get()->sortBy('id'),
            //Get al genres
            'genres' => Genre::all(),
            //Get current genre
            'currentGenre' => Genre::firstWhere('id', request('genre')),
            //Get current user
            'user' => User::find(auth()->id())
        ]);
    }

    /**
     * Display Admin Page.
     *
     */
    public function admin()
    {
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            //get all anime, genres and the user
            $animes = Anime::all();
            $genres = Genre::all();
            $user = User::find(auth()->id());
            //return the user
            return view('admin/overview', compact('animes', 'genres', 'user'));
        } else {
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
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            //get all genres and the user and the current selected genres
            $genres = Genre::all();
            $user = User::find(auth()->id());
            $animeGenres = [];
            return view('admin/addAnime', compact('genres', 'user', 'animeGenres'));
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
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            //create new Anime
            $anime = new Anime;

            //Check if all fields are filled
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'genre_id' => 'required|array',
                'episodes' => 'required|numeric',
                'rating' => "required|numeric",
                'season' => "required|string",
                'year' => "required|numeric",
                'image_card' => "required|max:10000|mimes:png",
                'image_show' => "required|max:10000|mimes:png,jpeg,jpg",
            ]);

            //input all request inputs and make an object of $anime
            $animeGenres = $request->input('genre_id');
            $anime->title = $request->input('title');
            $anime->description = $request->input('description');
            $anime->episodes = $request->input('episodes');
            $anime->rating = $request->input('rating');
            $anime->year = $request->input('season') . " " . $request->input('year');
            $anime->image_card = $request->file('image_card')->storePublicly('images/image_card', 'public');
            $anime->image_card = str_replace('images/image_card/', '', $anime->image_card);
            $anime->image_show = $request->file('image_show')->storePublicly('images/image_show', 'public');
            $anime->image_show = str_replace('images/image_show/', '', $anime->image_show);
            $anime->status = $request->input('status');

            //Save the new anime to the Database
            $anime->save();
            //make relations between the anime and the genres
            $anime->genres()->attach($request->input('genre_id'));
            //After Successfully creating the anime redirect back with a status
            return redirect()->route('admin')->with('status', 'Anime Added Successfully');
        } else {
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
        //get all genres and the user
        $genres = Genre::all();
        $user = User::find(auth()->id());
        //return the detail blade with the given anime
        return view('detail', compact('anime', 'genres', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Genre $genres
     * @return Application|Factory|View|Response
     */
    //TODO IF still working delete this
//    public function showGenre(Request $request, Genre $genres)
//    {
//
//        $genres = Genre::all();
//        return view('anime', compact('anime', 'genres'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return Application|Factory|View|Response
     */
    public function edit(Anime $anime)
    {
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            //get the relations, anime, genres and user
            $animeGenres = $anime->genres()->get();
            $anime = Anime::find($anime->id);
            $genres = Genre::all();
            $user = User::find(auth()->id());
            //return the edit page for the anime
            return view('admin/edit', compact('anime', 'genres', 'animeGenres', 'user'));
        } else {
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
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            $anime = Anime::find($anime->id);

            //Check if Title has been filled other wise skip this part of the edit
            if (!$request->input('title') == "") {
                $anime->title = $request->input('title');
            }

            //Check if Description has been filled other wise skip this part of the edit
            if (!$request->input('description') == "") {
                $anime->description = $request->input('description');
            }

            //Check if Episodes has been filled other wise skip this part of the edit
            if (!$request->input('episodes') == "") {
                $anime->episodes = $request->input('episodes');
            }

            //Check if Rating has been filled other wise skip this part of the edit
            if (!$request->input('rating') == "") {
                $anime->rating = $request->input('rating');
            }

            //Check if Season & Year has been filled other wise skip this part of the edit
            if (!$request->input('season') == "" && !$request->input('year') == "") {
                $anime->year = $request->input('season') . " " . $request->input('year');
            } //Check if Season has been filled other wise skip this part of the edit
            elseif (!$request->input('season') == "") {
                $anime->year = $request->input('season') . " " . substr($anime->year, -4);
            } //Check if Year has been filled other wise skip this part of the edit
            elseif (!$request->input('year') == "") {
                $anime->year = substr($anime->year, 0, -5) . " " . $request->input('year');
            }

            //Check if Image_card has been added other wise skip this part of the edit
            if (!$request->file('image_card') == "") {
                $anime->image_card = $request->file('image_card')->storePublicly('images/image_card', 'public');
                $anime->image_card = str_replace('images/image_card/', '', $anime->image_card);
            }
            //Check if Image_show has been added other wise skip this part of the edit
            if (!$request->file('image_show') == "") {
                $anime->image_show = $request->file('image_show')->storePublicly('images/image_show', 'public');
                $anime->image_show = str_replace('images/image_show/', '', $anime->image_show);
            }

            //save data
            $anime->save();
            //Detach past relations with genre
            $anime->genres()->detach();
            //Attach new relations with genre
            $anime->genres()->attach($request->input('genre_id'));
            //Redirect back to admin with status
            return redirect()->route('admin')->with('status', "Anime Updated");
        } else {
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
        //Check if user is an admin else return to home
        if (auth()->user()->role === 1) {
            //Detach past relations with genre
            $anime->genres()->detach();
            //Delete the anime for the Database
            $anime->delete();
            //redirect back with status
            return redirect()->back()->with('status', 'Anime Deleted');
        } else {
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
        //find the user
        $user = User::find(auth()->id());
        //find the user with given id
        $anime = Anime::find($request->input('id'));
        //save the data
        $anime->save();
        //Attach new relation with user
        $anime->user()->attach($user);
        //return with status
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
        //find the user
        $user = User::find(auth()->id());
        //check if relation exists and if the user has more than 2
        if ($user->anime()->exists() && count($user->anime()->get()) >= 2) {
            //find the user with given id
            $anime = Anime::find($request->input('id'));
            //save the data
            $anime->save();
            //Detach relation with anime
            $anime->user()->detach($user);
            //return with status

            return redirect()->back()->with('status', 'Anime Unfavorited');
        }
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        //find the requested anime or fail
        $anime = Anime::findOrFail($request->anime_id);
        //change status 1=on 0=off
        $anime->status = $request->status;
        //save data
        $anime->save();
        //return with status
        return response()->json(['status' => 'Anime status updated successfully.']);
    }
}
