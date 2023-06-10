<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\Entertainement;
use Illuminate\Http\Request;

class EntertainementSportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $entertainement = Entertainement::with('sport', 'timings')->where('entertainement_type', 'SPORT');

        if ($status !== null) {
            $entertainement->where('isVisible', $status);
        }

        return $entertainement->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['entertainement_type' => 'SPORT']); // Set entertainement_type as 'SPORT' for all sport entertainements

        if ($request->hasFile('sport_event_home_image')) {

            $entertainement = Entertainement::create($request->only([
                'entertainement_name',
                'entertainement_summary',
                'entertainement_description',
                'entertainement_type',
                'entertainement_age',
                'entertainement_location',
                'entertainement_joinable',
                'isVisible'
            ]));

            /* image handling */
            $homeImage = $request->file('sport_event_home_image');
            $homeImageName = str_replace(' ', '_', $request->input('sport_event_home_team')) . '.' . $homeImage->extension();
            $homeImage->storeAs('public/entertainement/sport', $homeImageName);


            $awayImageName = null;
            if ($request->hasFile('sport_event_away_image')) {
                $awayImage = $request->file('sport_event_away_image');
                $awayImageName = str_replace(' ', '_', $request->input('sport_event_away_team')) . '.' . $awayImage->extension();
                $awayImage->storeAs('public/entertainement/sport', $awayImageName);
            }


            /* sport handling */
            $entertainement->sport()->create([
                'sport_type' => $request->input('sport_type'),
                'sport_event' => $request->input('sport_event'),
                'sport_event_image' => $request->input('sport_event_image'),

                'sport_event_home_team' => $request->input('sport_event_home_team'),
                'sport_event_home_image' => $homeImageName,

                'sport_event_away_team' => $request->input('sport_event_away_team'),
                'sport_event_away_image' => $awayImageName,
                'entertainement_id' => $entertainement->id
            ]);

            /* timing handling */
            $start = strtotime($request->input('time_start'));
            $end = strtotime($request->input('time_end'));

            $entertainement->timings()->create([
                'date' => $request->input('date'),
                'time_start' => $request->input('time_start'),
                'time_end' => $request->input('time_end'),
                'duration' => gmdate("H:i", $end - $start),
                'is_repetetive' => $request->input('is_repetetive'),
                'entertainement_id' => $entertainement->id
            ]);

            return $entertainement;
        } else {
            return response()->json([
                'message' => 'Please upload an image'
            ], 422);
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
        return Entertainement::with('sport', 'timings')->find($id);
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
        $request->merge(['entertainement_type' => 'SPORT']); // Set entertainement_type as 'SPORT' for all sport entertainments

        $entertainement = Entertainement::findOrFail($id);

        $entertainement->update($request->only([
            'entertainement_name',
            'entertainement_summary',
            'entertainement_description',
            'entertainement_type',
            'entertainement_age',
            'entertainement_location',
            'entertainement_joinable',
            'isVisible'
        ]));

        /* image handling */
        if ($request->hasFile('sport_event_home_image')) {
            $homeImage = $request->file('sport_event_home_image');
            $homeImageName = str_replace(' ', '_', $request->input('sport_event_home_team')) . '.' . $homeImage->extension();
            $homeImage->storeAs('public/entertainement/sport', $homeImageName);
        }

        if ($request->hasFile('sport_event_away_image')) {
            $awayImage = $request->file('sport_event_away_image');
            $awayImageName = str_replace(' ', '_', $request->input('sport_event_away_team')) . '.' . $awayImage->extension();
            $awayImage->storeAs('public/entertainement/sport', $awayImageName);
        }

        /* sport handling */
        $entertainement->sport()->update([
            'sport_type' => $request->input('sport_type'),
            'sport_event' => $request->input('sport_event'),
            'sport_event_image' => $request->input('sport_event_image'),

            'sport_event_home_team' => $request->input('sport_event_home_team'),
            'sport_event_home_image' => isset($homeImageName) ? $homeImageName : $entertainement->sport->sport_event_home_image,

            'sport_event_away_team' => $request->input('sport_event_away_team'),
            'sport_event_away_image' => isset($awayImageName) ? $awayImageName : $entertainement->sport->sport_event_away_image,
        ]);

        return $entertainement;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Entertainement::destroy($id);
    }
}
