<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Models\User;
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

    public function index()
    {

        //Get all Data from the Anime Model
        $animes = Anime::all();
        $user = User::find(auth()->id());
        $genres = Genre::all();

//        $response = Http::get('https://api.jikan.moe/v3/top/anime/1/upcoming');
//        $animesTop = $response->collect('top')->take(3);

//      Anime API
//        foreach($animesTop as $animeTop){
//            $url = 'https://api.jikan.moe/v3/anime/' . $animeTop['mal_id'];
//            $response = Http::get($url);
//            $animeUrl = $response->collect();
//            array_push($anime, $animeUrl);
//        };

//      Genre API
        $url = HTTP::get('https://api.jikan.moe/v4/genres/anime');
        $urlGenres = $url->collect('data')->unique('mal_id');

        if($url){
            foreach ($urlGenres as $urlGenre) {
                $AddedGenres = false;
                // Iterate all ready items and attempt to find a match with item.
                foreach ($genres as $genre) {
                    if ($urlGenre['mal_id'] === $genre['id']) {
                        $AddedGenres = true;
                        break; // Stop iterating ready items if a match is found.
                    }
                }
                // Add item to $notReadyItems array if no match is found.
                if ($AddedGenres === false) {
                    $genre = new Genre;
                    $genre->id = $urlGenre['mal_id'];
                    $genre->name = $urlGenre['name'];
                    $genre->save();
                }
            }
        }
        return view('welcome', compact('animes', 'user'));
    }
}
