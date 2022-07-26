<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity_Lists;
use Illuminate\Http\Request;

class ActivityListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activity_Lists::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('activity_list_thumbnail')) {
            $request->file('activity_list_thumbnail')->store('public/excursions/thumbnails');
            return Activity_Lists::create([
                'activity_list_name' => $request->activity_list_name,
                'activity_list_duration' => $request->activity_list_duration,
                'activity_list_thumbnail' => $request->activity_list_thumbnail->hashName(),
                'activity_list_description' => $request->activity_list_description,
                'activity_list_meeting_point' => $request->activity_list_meeting_point,
                'activity_list_required_equipment' => $request->activity_list_required_equipment,
                'activity_list_zone' => $request->activity_list_zone,
                'activities_id' => $request->activities_id,
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
        return Activity_Lists::find($id);
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
        if ($request->hasFile('activity_list_thumbnail')) {
            $request->file('activity_list_thumbnail')->store('public/excursions/thumbnails');
            return Activity_Lists::find($id)->update([
                'activity_list_name' => $request->activity_list_name,
                'activity_list_duration' => $request->activity_list_duration,
                'activity_list_thumbnail' => $request->activity_list_thumbnail->hashName(),
                'activity_list_description' => $request->activity_list_description,
                'activity_list_meeting_point' => $request->activity_list_meeting_point,
                'activity_list_required_equipment' => $request->activity_list_required_equipment,
                'activity_list_zone' => $request->activity_list_zone,
                'activities_id' => Activity_Lists::find($id)->activities_id,
            ]);
        } else {
            return Activity_Lists::find($id)->update([
                'activity_list_name' => $request->activity_list_name,
                'activity_list_duration' => $request->activity_list_duration,
                'activity_list_description' => $request->activity_list_description,
                'activity_list_meeting_point' => $request->activity_list_meeting_point,
                'activity_list_required_equipment' => $request->activity_list_required_equipment,
                'activity_list_zone' => $request->activity_list_zone,
                'activities_id' => Activity_Lists::find($id)->activities_id,
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
        return Activity_Lists::destroy($id);
    }
}
