<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use http\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Object_;
use stdClass;
use function PHPUnit\Framework\callback;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $anime = [];

        $response = Http::get('https://api.jikan.moe/v3/top/anime/1/upcoming');
        $animesTop = $response->collect('top')->take(3);
//        dd($animesTop);

        foreach($animesTop as $animeTop){
            $url = 'https://api.jikan.moe/v3/anime/' . $animeTop['mal_id'];
            $response = Http::get($url);
            $animeUrl = $response->collect();
            array_push($anime, $animeUrl);
        };

        //Get all Data from the Anime Model
        $animes = Anime::with('genre')->get();
        return view('welcome', compact('animes', 'animesTop'));
    }

}
