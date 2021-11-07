<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelRequest;

use App\Travel;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::all();
        return view('pages.admin.travel.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.travel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Travel::create($data);
        return redirect()->route('travel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        return view('pages.admin.travel.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TravelRequest  $request
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function update(TravelRequest $request, Travel $travel)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Travel::findOrFail($travel->id)
            ->update($data);

        return redirect()->route('travel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        Travel::destroy($travel->id);

        return redirect()->route('travel.index');
    }
}
