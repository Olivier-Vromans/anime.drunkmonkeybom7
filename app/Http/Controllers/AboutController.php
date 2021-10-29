<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        //Controller for the page of About with until no nothing on it but this
        $title = "Over onze website";
        $paragraph = "Lorem ipsum dolor sit amer, consectetur adipisicing elit.";
        //return the blade with title and paragraph
        return view('about', compact('title', 'paragraph'));
    }
}
