<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FoodServicePlatesSupplements;
use Illuminate\Http\Request;

class FoodServicePlateSupplementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return FoodServicePlatesSupplements::where('food_service_plates_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return FoodServicePlatesSupplements::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FoodServicePlatesSupplements::with('plate')->find($id);
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
        return FoodServicePlatesSupplements::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return FoodServicePlatesSupplements::destroy($id);
    }
}
