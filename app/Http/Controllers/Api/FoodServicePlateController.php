<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodServicePlates;
use Illuminate\Http\Request;

class FoodServicePlateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return FoodServicePlates::with('supplements', 'category')->where('food_service_categories_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('plate_image')) {
            $request->file('plate_image')->store('public/room-service/food-service');
            return  FoodServicePlates::create([
                'plate_name' => $request->plate_name,
                'plate_image' => $request->file('plate_image')->hashName(),
                'plate_descripiton' => $request->plate_descripiton,
                'plate_price' => $request->plate_price,
                'plate_variance' => $request->plate_variance,
                'food_service_categories_id' => $request->food_service_categories_id,
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
        return FoodServicePlates::with('supplements', 'category')->find($id);
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
        if ($request->hasFile('plate_image')) {
            $request->file('plate_image')->store('public/room-service/food-service');
            return  FoodServicePlates::find($id)->update([
                'plate_name' => $request->plate_name,
                'plate_image' => $request->file('plate_image')->hashName(),
                'plate_descripiton' => $request->plate_descripiton,
                'plate_price' => $request->plate_price,
                'plate_variance' => $request->plate_variance,
            ]);
        } else {
            return  FoodServicePlates::find($id)->update([
                'plate_name' => $request->plate_name,
                'plate_descripiton' => $request->plate_descripiton,
                'plate_price' => $request->plate_price,
                'plate_variance' => $request->plate_variance,
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
        return FoodServicePlates::destroy($id);
    }
}
