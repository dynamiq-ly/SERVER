<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\room\RoomsListAdsOns;
use Illuminate\Http\Request;

class RoomAddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoomsListAdsOns::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['label',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/rooms/room-add-ons');
            $data['image'] = $request->file('image')->hashName();
        }

        return RoomsListAdsOns::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoomsListAdsOns::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['label',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/rooms/room-add-ons');
            $data['image'] = $request->file('image')->hashName();;
        }

        $roomsAddons = RoomsListAdsOns::findOrFail($id);
        return $roomsAddons->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RoomsListAdsOns::destroy($id);
    }
}
