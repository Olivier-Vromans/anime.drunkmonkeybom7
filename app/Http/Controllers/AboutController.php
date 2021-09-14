<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = "Over onze website";
        $paragraph = "Lorem ipsum dolor sit amer, consectetur adipisicing elit.";

        return view('about', compact('title', 'paragraph'));
    }
}
