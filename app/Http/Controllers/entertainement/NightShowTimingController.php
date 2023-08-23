<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\entertainement\NightShowTiming;
use Illuminate\Http\Request;

class NightShowTimingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NightShowTiming::with('night')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return NightShowTiming::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return NightShowTiming::with('night')->find($id);
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
        return NightShowTiming::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return NightShowTiming::destroy($id);
    }

    /**
     * fetch data grouped by date and day
     */
    public function groupBy(Request $request)
    {
        $timings = NightShowTiming::with('night.timing')->get();
        $groupedTimings = $timings->groupBy(function ($timing) {
            return $timing->day;
        })->map(function ($group) {
            return $group->groupBy(function ($timing) {
                return $timing->start_time;
            });
        });
        return $groupedTimings;
    }
}
