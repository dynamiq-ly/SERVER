<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\room\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query !== null) {
            return RoomCategory::where('visible', $query)->get();
        }

        return RoomCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return RoomCategory::create([
            'label' => $request->label,
            'visible' => $request->visible,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RoomCategory::find($id);
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
        return RoomCategory::find($id)->update([
            'label' => $request->label,
            'visible' => $request->visible,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RoomCategory::destroy($id);
    }
}
