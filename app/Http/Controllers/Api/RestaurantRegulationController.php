<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantRegulation;
use Illuminate\Http\Request;

class RestaurantRegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return RestaurantRegulation::where('restaurant_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return RestaurantRegulation::create([
            'restaurant_id' => $request->restaurant_id,
            'restaurant_regulations_name' => $request->restaurant_regulations_name,
            'restaurant_regulations_description' => $request->restaurant_regulations_description,
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
        return RestaurantRegulation::find($id);
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
        return RestaurantRegulation::find($id)->update([
            'restaurant_id' => $request->restaurant_id,
            'restaurant_regulations_name' => $request->restaurant_regulations_name,
            'restaurant_regulations_description' => $request->restaurant_regulations_description,
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
        return RestaurantRegulation::destroy($id);
    }
}
