<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\entertainement\DayActivityTiming;
use Illuminate\Http\Request;

class DayActivityTimingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DayActivityTiming::with('activity')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DayActivityTiming::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DayActivityTiming::with('activity')->find($id);
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
        return DayActivityTiming::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DayActivityTiming::destroy($id);
    }

    /**
    * fetch data grouped by date and day
    */
    public function groupBy(Request $request)
    {
        $timings = DayActivityTiming::with('activity.timing')->get();
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
