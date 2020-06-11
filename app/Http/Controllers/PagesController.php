<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function showWelcome()
    {
        return view('pages.welcome');
    }
}
