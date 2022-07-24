<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ActivitiesRequest;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activities::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ActivitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivitiesRequest $request)
    {
        if ($request->hasFile('activity_image')) {
            $request->file('activity_image')->store('public/excursions/thumbnails');
            return Activities::create([
                'activity_name' => $request->activity_name,
                'activity_image' => $request->file('activity_image')->hashName(),
            ]);
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
        return Activities::find($id);
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
        if ($request->hasFile('activity_image')) {
            $request->file('activity_image')->store('public/excursions/thumbnails');
            return Activities::find($id)->update([
                'activity_name' => $request->activity_name,
                'activity_image' => $request->file('activity_image')->hashName(),
            ]);
        } else {
            return Activities::find($id)->update([
                'activity_name' => $request->activity_name,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Activities::destroy($id);
    }
}
