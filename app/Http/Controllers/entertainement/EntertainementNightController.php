<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\Entertainement;
use Illuminate\Http\Request;

class EntertainementNightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $entertainement = Entertainement::with('show', 'images', 'timings')->where('entertainement_type', 'NIGHT');

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
        $request->merge(['entertainement_type' => 'NIGHT']); // Set entertainement_type as 'NIGHT' for all night entertainements

        if ($request->hasFile('images')) {

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
            foreach ($request->file('images') as $image) {
                $imageName = str_replace(' ', '_', $entertainement->entertainement_name) . time() . '.' . $image->extension();
                $image->storeAs('public/entertainement/night', $imageName);
                $entertainement->images()->create([
                    'image' => $imageName,
                    'image_description' => $request->input('image_description'),
                    'entertainement_id' => $entertainement->id
                ]);
            }

            /* show handling */
            $entertainement->show()->create([
                'night_show_price' => $request->input('night_show_price'),
                'night_show_tickets' => $request->input('night_show_tickets'),
                'night_show_link' => $request->input('night_show_link'),
                'night_show_video' => $request->input('night_show_video'),
                'night_show_genre' => $request->input('night_show_genre'),
                'night_show_performers' => $request->input('night_show_performers'),
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
                'message' => 'Please upload at least one image'
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
        return Entertainement::with('show', 'images', 'timings')->find($id);
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
        $request->merge(['entertainement_type' => 'NIGHT']); // Set entertainement_type as 'NIGHT' for all night entertainements

        $entertainement = Entertainement::findOrfail($id);

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

        /* show handling */
        $entertainement->show()->update([
            'night_show_price' => $request->input('night_show_price'),
            'night_show_tickets' => $request->input('night_show_tickets'),
            'night_show_link' => $request->input('night_show_link'),
            'night_show_video' => $request->input('night_show_video'),
            'night_show_genre' => $request->input('night_show_genre'),
            'night_show_performers' => $request->input('night_show_performers'),
            'entertainement_id' => $entertainement->id
        ]);

        /* image handling */
        if ($request->hasFile('images')) {
            $entertainement->images()->delete(); // Remove existing images

            foreach ($request->file('images') as $image) {
                $imageName = str_replace(' ', '_', $entertainement->entertainement_name) . time() . '.' . $image->extension();
                $image->storeAs('public/entertainement/night', $imageName);
                $entertainement->images()->create([
                    'image' => $imageName,
                    'image_description' => $request->input('image_description'),
                    'entertainement_id' => $entertainement->id
                ]);
            }
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
        return Entertainement::destroy($id);
    }
}
