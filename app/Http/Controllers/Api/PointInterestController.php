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
            return PointInterest::with('images', 'schedule', 'pointType')->where('point_status', 1)->get();
        else if ($bool == -1)
            return PointInterest::with('images', 'schedule')->leftJoin('point_interest_types', 'point_interest_types.id', '=', 'point_interests.id')->where('point_status', 0)->get();
        else 
    if ($bool == 0)
            return PointInterest::with('images')->leftJoin('point_interest_types', 'point_interest_types.id', '=', 'point_interests.id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $point = PointInterest::create($request->only(
            'point_title',
            'point_small_summary',
            'point_description',
            'point_contact_number',
            'point_website_information',
            'point_textual_location',
            'point_cords_location',
            'point_recommended_visit',
            'point_status',
            'point_interest_types_id'
        ));


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/points-of-interest');
                $point->images()->create([
                    'image' => $image->hashName(),
                    'point_id' => $point->id
                ]);
            }
        }


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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PointInterest::with('images', 'schedule')->leftJoin('point_interest_types', 'point_interest_types.id', '=', 'point_interests.id')->find($id);
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
            'point_interest_types_id'
        ));


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/points-of-interest');
                $point->images()->update([
                    'image' => $image->hashName(),
                    'point_id' => $point->id
                ]);
            }
        }


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
