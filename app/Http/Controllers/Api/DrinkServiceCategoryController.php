<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DrinkServiceCategory;
use Illuminate\Http\Request;

class DrinkServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DrinkServiceCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('drink_drink_image')) {
            $request->file('drink_drink_image')->store('public/room-service/drink-service');
            return DrinkServiceCategory::create([
                'drink_drink_category' => $request->drink_drink_category,
                'drink_drink_image' => $request->drink_drink_image->hashName(),
                'drink_drink_type' => $request->drink_drink_type
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
        return DrinkServiceCategory::find($id);
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
        if ($request->hasFile('drink_drink_image')) {
            $request->file('drink_drink_image')->store('public/room-service/drink-service');
            return DrinkServiceCategory::find($id)->update([
                'drink_drink_category' => $request->drink_drink_category,
                'drink_drink_image' => $request->drink_drink_image->hashName(),
                'drink_drink_type' => $request->drink_drink_type
            ]);
        } else {
            return DrinkServiceCategory::find($id)->update([
                'drink_drink_category' => $request->drink_drink_category,
                'drink_drink_type' => $request->drink_drink_type
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
        return DrinkServiceCategory::destroy($id);
    }
}
