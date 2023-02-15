<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourAgencyService;
use Illuminate\Http\Request;

class TourAgencyServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TourAgencyService::with('agency', 'timing')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return TourAgencyService::create([
            'agency_service_title' => $request->agency_service_title,
            'agency_service_link' => $request->agency_service_link,
            'agencies_id' => $request->agencies_id
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
        return TourAgencyService::with('agency', 'timing')->find($id);
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
        return TourAgencyService::find($id)->update([
            'agency_service_title' => $request->agency_service_title,
            'agency_service_link' => $request->agency_service_link,
            'tour_agencies_id' => $request->tour_agencies_id
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
        return TourAgencyService::destroy($id);
    }
}
