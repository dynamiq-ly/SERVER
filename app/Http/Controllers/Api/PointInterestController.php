<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointInterest;
use Illuminate\Http\Request;

class PointInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $bool
     * @return \Illuminate\Http\Response
     */
    public function index($bool = null)
    {
        if ($bool == 1)
            return PointInterest::with('schedule', 'pointType')->where('point_status', 1)->get();
        else if ($bool == -1)
            return PointInterest::with('schedule', 'pointType')->where('point_status', 0)->get();
        else 
    if ($bool == 0)
            return PointInterest::with('schedule', 'pointType')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageuploads = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/points-of-interest');
                $imageuploads[] = $image->hashName();
            }
        }

        $point = PointInterest::create([
            'point_title' => $request->point_title,
            'point_small_summary' => $request->point_small_summary,
            'point_description' => $request->point_description,
            'point_contact_number' => $request->point_contact_number,
            'point_website_information' => $request->point_website_information,
            'point_textual_location' => $request->point_textual_location,
            'point_cords_location' => $request->point_cords_location,
            'point_recommended_visit' => $request->point_recommended_visit,
            'point_status' => $request->point_status,
            'images' => json_encode($imageuploads),
            'point_interest_types_id' => $request->point_interest_types_id
        ]);

        $point->schedule()->create([
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'point_id' => $point->id
        ]);

        // PointInterest::find($point->id)->update([
        //     'images' => $imageuploads
        // ]);

        return $point;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PointInterest::with('schedule', 'pointType')->find($id);
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
        $point = PointInterest::find($id)->update($request->only(
            'point_title',
            'point_small_summary',
            'point_description',
            'point_contact_number',
            'point_website_information',
            'point_textual_location',
            'point_cords_location',
            'point_recommended_visit',
            'point_status',
            'images',
            'point_interest_types_id'
        ));


        $point->schedule()->update([
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'point_id' => $point->id
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
        return PointInterest::destroy($id);
    }
}
