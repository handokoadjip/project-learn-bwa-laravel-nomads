<?php

namespace App\Http\Controllers;

use App\Travel;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $travel = Travel::where('slug', $slug)->firstOrFail();
        return view('pages.detail', compact('travel'));
    }
}
