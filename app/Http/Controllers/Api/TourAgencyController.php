<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourAgency;
use Illuminate\Http\Request;

class TourAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TourAgency::with('services', 'guides.timing')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('agency_image')) {
            $request->file('agency_image')->store('public/tour-operator/agency');
            return TourAgency::create([
                'agency_title' => $request->agency_title,
                'agency_summary' => $request->agency_summary,
                'agency_description' => $request->agency_description,
                'agency_website' => $request->agency_website,
                'agency_image' => $request->file('agency_image')->hashName(),
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
        return TourAgency::with('services', 'guides.timing')->find($id);
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
        if ($request->hasFile('agency_image')) {
            $request->file('agency_image')->store('public/tour-operator/agency');
            return TourAgency::find($id)->update([
                'agency_title' => $request->agency_title,
                'agency_summary' => $request->agency_summary,
                'agency_description' => $request->agency_description,
                'agency_website' => $request->agency_website,
                'agency_image' => $request->file('agency_image')->hashName(),
            ]);
        } else {
            return TourAgency::find($id)->update([
                'agency_title' => $request->agency_title,
                'agency_summary' => $request->agency_summary,
                'agency_description' => $request->agency_description,
                'agency_website' => $request->agency_website,
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
        return TourAgency::destroy($id);
    }
}
