<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\room\RoomAddonsManyToMany;
use Illuminate\Http\Request;

class RoomAddonsManytoManyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $addons = RoomAddonsManyToMany::with('addon');
        $room = $request->input('query');

        if ($room != null) {
            return $addons->where('room_id', $room)->get();
        }

        return $addons->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return RoomAddonsManyToMany::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoomAddonsManyToMany::with('room', 'addon')->find($id);
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
        return RoomAddonsManyToMany::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RoomAddonsManyToMany::destroy($id);
    }
}
