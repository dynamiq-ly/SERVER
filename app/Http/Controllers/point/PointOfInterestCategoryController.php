<?php

namespace App\Http\Controllers\point;

use App\Http\Controllers\Controller;
use App\Models\point\PointOfInterestCategory;
use Illuminate\Http\Request;

class PointOfInterestCategoryController extends Controller
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
            return PointOfInterestCategory::where('visible', $query)->with('points')->get();
        }

        return PointOfInterestCategory::with('points.images')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return PointOfInterestCategory::create([
            'name' => $request->name,
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
        return PointOfInterestCategory::find($id);
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
        return PointOfInterestCategory::find($id)->update([
            'name' => $request->name,
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
        return PointOfInterestCategory::destroy($id);
    }
}
