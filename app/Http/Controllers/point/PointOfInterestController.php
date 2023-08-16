<?php

namespace App\Http\Controllers\point;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointOfInterest;
use App\Models\point\PointOfInterest;
use Illuminate\Http\Request;

class PointOfInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $points = PointOfInterest::with('images', 'schedule', 'category');

        $visible = $request->input('visible');
        $category = $request->input('query');

        if ($visible != null && $category != null) {
            return $points->where('visible', $visible)->where('point_id', $category)->get();
        }

        return $points->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointOfInterest $request)
    {
        if ($request->hasFile('images')) {
            $point = PointOfInterest::create($request->only([
                'name',
                'location',
                'coordinates',
                'phone',
                'website',
                'description',
                'point_id',
                'visible'
            ]));

            /* image handling */
            foreach ($request->file('images') as $image) {
                $image->store('public/point-of-interest');
                $point->images()->create([
                    'image' => $image->hashName(),
                    'point_id' => $point->id
                ]);
            }

            /* schedule handling */
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

            return $point;
        }
        return response()->json(['message' => 'No images found'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PointOfInterest::with('category', 'images', 'schedule')->find($id);
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
        $point = PointOfInterest::find($id);

        $point->update($request->only([
            'name',
            'location',
            'coordinates',
            'phone',
            'website',
            'description',
            'point_id',
            'visible'
        ]));

        /* Image handling */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/point-of-interest');
                $point->images()->create([
                    'image' => $image->hashName(),
                    'point_id' => $point->id
                ]);
            }
        }

        /* Schedule handling */
        if ($request->has('schedule')) {
            $point->schedule()->update([
                'sunday' => $request->sunday,
                'monday' => $request->monday,
                'tuesday' => $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
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
        return PointOfInterest::destroy($id);
    }
}
