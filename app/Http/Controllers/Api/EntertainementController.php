<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entertainement;
use Illuminate\Http\Request;

class EntertainementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $bool
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function index($bool = null, $type = '')
    {
        if ($type == '') {
            if ($bool == 1)
                return Entertainement::with('timings', 'images')->where('entertainements_status', 1)->get();
            else if ($bool == -1)
                return Entertainement::with('timings', 'images')->where('entertainements_status', 0)->get();
            else if ($bool == 0)
                return Entertainement::with('timings', 'images')->get();
        } else {

            switch ($type) {
                case 'nightShows':
                    if ($bool == 1)
                        return Entertainement::with('timings', 'images', 'nightShows')->where('entertainements_status', 1)->where('entertainements_type', 'night shows')->get();
                    else if ($bool == 0)
                        return Entertainement::with('timings', 'images')->where('entertainements_status', 0)->where('entertainements_type', 'night shows')->get();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entertainement = Entertainement::create($request->only(
            'entertainements_title',
            'entertainements_type',
            'entertainements_summary',
            'entertainements_description',
            'entertainements_location',
            'entertainements_duration',
            'entertainements_location_can_join',
            'entertainements_status'
        ));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/entertainement');
                $entertainement->images()->create([
                    'image' => $image->hashName(),
                    'entertainements_id' => $entertainement->id
                ]);
            }
        }

        if ($request->has('entertainement_timings_date')) {
            foreach ($request->entertainement_timings_date as $value) {
                $entertainement->timings()->create([
                    'entertainement_timings_date' => $value,
                    'entertainements_id' => $entertainement->id
                ]);
            }
        }

        switch ($request->entertainements_type) {
            case 'night shows':
                $entertainement->nightShows()->create([
                    'night_show_web_link' => $request->night_show_web_link,
                    'night_show_leader' => $request->night_show_leader,
                    'night_show_assisatant' => $request->night_show_assisatant,
                    'night_show_video_link' => $request->night_show_video_link,
                    'night_show_ticked_price' => $request->night_show_ticked_price,
                    'night_show_audience' => $request->night_show_audience,
                    'night_show_type' => $request->night_show_type,
                    'entertainements_id' => $entertainement->id
                ]);
                return Entertainement::with('timings', 'images', 'nightShows')->find($entertainement->id);
            default:
                return response()->json(['error' => 405, 'message' => 'failed to insert data correctly']);
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
        return Entertainement::with('timings', 'images', 'nightShows')->find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
