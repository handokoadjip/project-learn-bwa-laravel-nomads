<?php

namespace App\Http\Controllers;

use App\Travel;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $travels = Travel::all();
        return view('pages.home', compact('travels'));
    }
}
