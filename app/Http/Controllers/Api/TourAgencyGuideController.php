<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourAgencyGuide;
use Illuminate\Http\Request;

class TourAgencyGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TourAgencyGuide::with('agency', 'timing')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('guide_image')) {
            $request->file('guide_image')->store('public/tour-operator/guides');
            $tour = TourAgencyGuide::create([
                'guide_name' => $request->guide_name,
                'guide_about' => $request->guide_about,
                'guide_phone' => $request->guide_phone,
                'guide_email' => $request->guide_email,
                'guide_link' => $request->guide_link,
                'guide_instagram' => $request->guide_instagram,
                'guide_lang_spoken' => $request->guide_lang_spoken,
                'guide_image' => $request->file('guide_image')->hashName(),
                'agencies_id' => $request->agencies_id,
            ]);

            $tour->timing()->create([
                'sunday' => $request->sunday,
                'monday' => $request->monday,
                'tuesday' => $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
                'guide_id' => $tour->id
            ]);

            return $tour;
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
        return TourAgencyGuide::with('timing')->find($id);
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
        if ($request->hasFile('guide_image')) {
            $request->file('guide_image')->store('public/tour-operator/guides');
            TourAgencyGuide::find($id)->update([
                'guide_name' => $request->guide_name,
                'guide_about' => $request->guide_about,
                'guide_phone' => $request->guide_phone,
                'guide_email' => $request->guide_email,
                'guide_link' => $request->guide_link,
                'guide_instagram' => $request->guide_instagram,
                'guide_lang_spoken' => $request->guide_lang_spoken,
                'guide_image' => $request->file('guide_image')->hashName(),
                'agencies_id' => $request->agencies_id,
            ]);


            TourAgencyGuide::find($id)->timing()->update([
                'sunday' => $request->sunday,
                'monday' => $request->monday,
                'tuesday' => $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
                // 'guide_id' => TourAgencyGuide::find($id)->id
            ]);
        } else {
            TourAgencyGuide::find($id)->update([
                'guide_name' => $request->guide_name,
                'guide_about' => $request->guide_about,
                'guide_phone' => $request->guide_phone,
                'guide_email' => $request->guide_email,
                'guide_link' => $request->guide_link,
                'guide_instagram' => $request->guide_instagram,
                'guide_lang_spoken' => $request->guide_lang_spoken,
                'agencies_id' => $request->agencies_id,
            ]);

            TourAgencyGuide::find($id)->timing()->update([
                'sunday' => $request->sunday,
                'monday' => $request->monday,
                'tuesday' => $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
                // 'guide_id' => TourAgencyGuide::find($id)->id
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
        return TourAgencyGuide::destroy($id);
    }
}
