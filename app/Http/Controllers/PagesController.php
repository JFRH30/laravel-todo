<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    /**
     * Display pre-login page.
     */
    public function showWelcome()
    {
        return view('pages.welcome');
    }

    /**
     * Display post-login page.
     */
    public function showHome()
    {
        return view('pages.home');
    }
}
