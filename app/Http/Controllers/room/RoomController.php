<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\room\RoomsList;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $roomsQuery = RoomsList::with('category', 'images', 'config', 'features', 'addons.addon');

        if ($query !== null) {
            $roomsQuery->whereHas('config', function ($configQuery) use ($query) {
                $configQuery->where('visible', $query);
            });
        }

        $rooms = $roomsQuery->get();

        return $rooms;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('images')) {
            $room = RoomsList::create($request->only([
                'name',
                'slug',
                'price',
                'description',
                'virtual',
                'room_floor',
                'room_number',
                'room_id',
            ]));


            /* image handling */
            foreach ($request->file('images') as $image) {
                $image->store('public/rooms');
                $room->images()->create([
                    'image' => $image->hashName(),
                    'room_id' => $room->id
                ]);
            }

            /* config handling */
            $room->config()->create([
                'visible' => $request->visible,
                'booking' => $request->booking,
                'upgrade-price' => $request->input('upgrade-price'),
                'downgrade-price' => $request->input('downgrade-price'),
                'upgrade-description' => $request->input('upgrade-description'),
                'room_id' => $room->id
            ]);
            return $room;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoomsList::with('category', 'images', 'config', 'features', 'addons.addon')->find($id);
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
        $room = RoomsList::findOrFail($id);

        $room->update($request->only([
            'name',
            'slug',
            'price',
            'description',
            'virtual',
            'room_floor',
            'room_number',
            'room_id',
        ]));

        if ($request->hasFile('images')) {
            /* Image handling */
            foreach ($request->file('images') as $image) {
                $image->store('public/rooms');
                $room->images()->create([
                    'image' => $image->hashName(),
                    'room_id' => $room->id,
                ]);
            }
        }

        /* Config handling */
        $room->config()->update([
            'visible' => $request->visible,
            'booking' => $request->booking,
            'upgrade-price' => $request->input('upgrade-price'),
            'downgrade-price' => $request->input('downgrade-price'),
            'upgrade-description' => $request->input('upgrade-description'),
            'room_id' => $room->id,
        ]);
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RoomsList::destroy($id);
    }
}
