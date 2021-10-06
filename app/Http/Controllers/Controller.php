<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use http\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $response = Http::get('https://api.jikan.moe/v3/top/anime/1/upcoming');
        $animesTop = $response->collect('top');
//        dd($animesTop);

        //Get all Data from the Anime Model
        $animes = Anime::with('genre')->get();
        return view('welcome', compact('animes', 'animesTop'));
    }

}
