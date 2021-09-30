<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){


        //Get all Data from the Anime Model
        $animes = Anime::with('genre')->get();
        return view('welcome', compact('animes'));
    }
}
