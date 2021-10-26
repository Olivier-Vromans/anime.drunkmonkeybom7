<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
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
     * @return Application|Factory|View|Response
     */
    public function show(Request $request, $id)
    {
        if (auth()->user()->id == intval($id)){
            $user = User::find($id);
            $animes = Anime::all();
            $genres = Genre::all();
            return view('users.myprofile', compact('user', 'animes', 'genres'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(Request $request, $id)
    {
        if (auth()->user()->id == intval($id)){
            $user = User::find($id);
            return view('users/editprofile', compact( 'user'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()){
            $user = User::find($user->id);

//              Check if Firstname has been filled other wise skip this part of the edit
            if (!$request->input('firstname') == "") {
                $user->firstname = $request->input('firstname');
            }

//              Check if Lastname has been filled other wise skip this part of the edit
            if (!$request->input('lastname') == "") {
                $user->lastname = $request->input('lastname');
            }

//              Check if Username has been filled other wise skip this part of the edit
            if (!$request->input('username') == "") {
                $user->username = $request->input('username');
            }

//        Check if profile_picture has been added other wise skip this part of the edit
            if (!$request->file('profile_picture') == ""){
                $user->profile_picture = $request->file('profile_picture')->storePublicly('images/profile_picture', 'public');
                $user->profile_picture = str_replace('images/profile_picture', '', $user->profile_picture);
            }

            //        save data
            $user->save();
            //        Redirect back to admin with status
            return redirect()->route('user.show', $user)->with('status', "Profile Updated");
        }else{
            return redirect()->route('/');
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

    /**
     * Store favorite in storage.
     *
     * @param Request $request
     * @param Anime $anime
     * @return RedirectResponse
     */

}
