<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Code to be executed if the user is authenticated
        return view('home');
    }
}
