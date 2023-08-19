<?php

namespace App\Http\Controllers\bar;

use App\Http\Controllers\Controller;
use App\Models\bar\BarsList;
use Illuminate\Http\Request;

class BarsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query('query');
        $bars = BarsList::with('images', 'staff', 'menu');

        if ($query != null) {
            return $bars->where('visible', $query)->get();
        }

        return $bars->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'type',
            'location',
            'phone_number',
            'description',
            'timing_open',
            'timing_close',
            'reservation_required',
            'adults_only',
            'visible',
        ]);

        if ($request->hasFile('images')) {

            if ($request->hasFile('menu_a_la_carte')) {
                $menuFile = $request->file('menu_a_la_carte');
                $menuFile->store('public/pdf/menus/bar'); // You might want to change the directory

                $data['menu_a_la_carte'] = $menuFile->hashName();
            }

            $bar = BarsList::create($data);

            /* image handling */
            foreach ($request->file('images') as $image) {
                $image->store('public/bars');
                $bar->images()->create([
                    'image' => $image->hashName(),
                    'bar_id' => $bar->id
                ]);
            }

            return $bar;
        }
        return response()->json([
            'message' => 'Please upload at least one image'
        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BarsList::with('images', 'staff', 'menu')->find($id);
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
        // Find the existing BarsList record by ID
        $bar = BarsList::findOrFail($id);

        // Extract the input data from the request
        $data = $request->only([
            'title',
            'type',
            'location',
            'phone_number',
            'description',
            'timing_open',
            'timing_close',
            'reservation_required',
            'adults_only',
            'visible',
        ]);

        // Handle images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/bars');
                $bar->images()->create([
                    'image' => $image->hashName(),
                    'bar_id' => $bar->id
                ]);
            }
        }

        // Handle menu_a_la_carte file if provided
        if ($request->hasFile('menu_a_la_carte')) {
            $menuFile = $request->file('menu_a_la_carte');
            $menuFile->store('public/pdf/menus/bar'); // You might want to change the directory

            $data['menu_a_la_carte'] = $menuFile->hashName();
        }

        if ($request->delete_pdf !== null) {
            $data['menu_a_la_carte'] = null;
        }

        // Update the BarsList record with the modified data
        return $bar->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarsList::destroy($id);
    }
}
