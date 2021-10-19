<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $users = User::all();
        return redirect('/');
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function show(User $user)
    {
        $user = User::find(auth()->id());
        $animes = Anime::all();
        $genres = Genre::all();
        if (auth()->user()){
            $user = User::find($user->id);
            return view('users.myprofile', compact('user', 'animes', 'genres'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return Response
     */
    public function update(User $user)
    {
        if (auth()->user()){
            $user = User::find($user->id);

            //        Check if Title has been filled other wise skip this part of the edit
            if (!$request->input('firstname') == "") {
                $user->title = $request->input('firstname');
            }

            //        Check if Description has been filled other wise skip this part of the edit
            if (!$request->input('lastname') == "") {
                $user->description = $request->input('lastname');
            }

            //        Check if Image_card has been added other wise skip this part of the edit
            if (!$request->file('profile_picture') == ""){
                $user->image_card = $request->file('profile_picture')->storePublicly('images', 'public');
                $user->image_card = str_replace('images/profile_picture', '', $user->image_card);
            }

            //        save data
            $user->save();
            //        Detach past relations with genre
            $user->genres()->detach();
            //        Attach new relations with genre
            $user->genres()->attach($request->input('genre_id'));
            //        Redirect back to admin with status
            return redirect()->route('admin')->with('status', "Anime Updated");
        }else{
            return redirect()->route('users.myprofile');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
