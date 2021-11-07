<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPhotoRequest;

use App\Travel;
use App\TravelPhoto;
use Illuminate\Support\Facades\Storage;

class TravelPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelPhotos = TravelPhoto::all();

        return view('pages.admin.travel-photo.index', compact('travelPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $travels = TravelPhoto::all();
        $travels = Travel::all();

        return view('pages.admin.travel-photo.create', compact('travels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPhotoRequest $request)
    {
        $data = $request->all();
        $data['path'] = Storage::disk('public')->putFile(
            'assets/travel/photos',
            $request->file('photo')
        );

        TravelPhoto::create($data);
        return redirect()->route('travel-photo.index');
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
     * @param  \App\TravelPhoto $TravelPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(TravelPhoto $travelPhoto)
    {
        $travels = Travel::all();
        return view('pages.admin.travel-photo.edit', compact('travelPhoto', 'travels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\TravelPhotoRequest  $request
     * @param  \App\TravelPhoto $travelPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPhotoRequest $request, TravelPhoto $travelPhoto)
    {
        $data = $request->all();
        $data['path'] = Storage::disk('public')->putFile(
            'assets/travel/photos',
            $request->file('photo')
        );

        Storage::delete('public/' . $travelPhoto->path);

        TravelPhoto::findOrFail($travelPhoto->id)
            ->update($data);

        return redirect()->route('travel-photo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TravelPhoto $travelPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TravelPhoto $travelPhoto)
    {
        TravelPhoto::destroy($travelPhoto->id);

        return redirect()->route('travel-photo.index');
    }
}
