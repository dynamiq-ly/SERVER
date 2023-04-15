<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantRegulation;
use Illuminate\Http\Request;

class RestaurantRegulationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $regulations = RestaurantFoodMenu::with('restaurant');

        if ($query !== null) {
            $regulations->where('restaurant_id', $query);
        }

        return $regulations->get();
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
                $image->store('public/restaurants/regulations');
                $imageuploads[] = $image->hashName();
            }

            RestaurantRegulation::create([
                'regulation_name' => $request->input('regulation_name'),
                'regulation_description' => $request->input('regulation_description'),
                'regulation_images' => json_encode($imageuploads),
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
        return RestaurantRegulation::with('restaurant')->find($id);
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
        $regulation = RestaurantRegulation::find($id);

        $regulation->regulation_name = $request->input('regulation_name');
        $regulation->regulation_description = $request->input('regulation_description');

        if ($request->hasFile('images')) {
            $imageuploads = [];

            foreach ($request->file('images') as $image) {
                $image->store('public/restaurants/regulations');
                $imageuploads[] = $image->hashName();
            }

            $regulation->regulation_images = json_encode($imageuploads);
        }

        $regulation->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RestaurantRegulation::destroy($id);
    }
}
