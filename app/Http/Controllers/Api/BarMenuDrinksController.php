<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarMenuDrinks;
use Illuminate\Http\Request;

class BarMenuDrinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return BarMenuDrinks::where('menu_drink_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('bar_drink_image')) {
            $request->file('bar_drink_image')->store('public/bars/drinks');
            return BarMenuDrinks::create([
                'bar_drink_name' => $request->bar_drink_name,
                'bar_drink_image' => $request->bar_drink_image->hashName(),
                'bar_drink_price' => $request->bar_drink_price,
                'drink_bar_strengh' => $request->drink_bar_strengh,
                'drink_served_one' => $request->drink_served_one,
                'bar_drink_served' => $request->bar_drink_served,
                'drink_main_alcohol' => $request->drink_main_alcohol,
                'bar_drink_preperation' => $request->bar_drink_preperation,
                'bar_drink_ingredient' => $request->bar_drink_ingredient,
                'menu_drink_id' => $request->menu_drink_id,
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
        return BarMenuDrinks::find($id);
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
        if ($request->hasFile('bar_drink_image')) {
            $request->file('bar_drink_image')->store('public/bars/drinks');
            return BarMenuDrinks::find($id)->update([
                'bar_drink_name' => $request->bar_drink_name,
                'bar_drink_image' => $request->bar_drink_image->hashName(),
                'bar_drink_price' => $request->bar_drink_price,
                'drink_bar_strengh' => $request->drink_bar_strengh,
                'drink_served_one' => $request->drink_served_one,
                'bar_drink_served' => $request->bar_drink_served,
                'drink_main_alcohol' => $request->drink_main_alcohol,
                'bar_drink_preperation' => $request->bar_drink_preperation,
                'bar_drink_ingredient' => $request->bar_drink_ingredient,
                'menu_drink_id' => $request->menu_drink_id,
            ]);
        } else {
            return BarMenuDrinks::find($id)->update([
                'bar_drink_name' => $request->bar_drink_name,
                'bar_drink_price' => $request->bar_drink_price,
                'drink_bar_strengh' => $request->drink_bar_strengh,
                'drink_served_one' => $request->drink_served_one,
                'bar_drink_served' => $request->bar_drink_served,
                'drink_main_alcohol' => $request->drink_main_alcohol,
                'bar_drink_preperation' => $request->bar_drink_preperation,
                'bar_drink_ingredient' => $request->bar_drink_ingredient,
                'menu_drink_id' => $request->menu_drink_id,
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
        return BarMenuDrinks::destroy($id);
    }
}
