<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantServings;
use Illuminate\Http\Request;

class RestaurantServingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $servings = RestaurantServings::with('restaurant');

        if ($query !== null) {
            $servings->where('restaurant_id', $query);
        }

        return $servings->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return RestaurantServings::create([
            'serving_name' => $request->input('serving_name'),
            'serving_description' => $request->input('serving_description'),
            'serving_opens' => $request->input('serving_opens'),
            'serving_closes' => $request->input('serving_closes'),
            'restaurant_id' => $request->input('restaurant_id'),
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
        return RestaurantServings::with('restaurant')->find($id);
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
        return RestaurantServings::find($id)->update([
            'serving_name' => $request->input('serving_name'),
            'serving_description' => $request->input('serving_description'),
            'serving_opens' => $request->input('serving_opens'),
            'serving_closes' => $request->input('serving_closes'),
            'restaurant_id' => $request->input('restaurant_id'),
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
        return RestaurantServings::destroy($id);
    }
}
