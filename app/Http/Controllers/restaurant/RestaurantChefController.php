<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\RestaurantChef;
use Illuminate\Http\Request;

class RestaurantChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $chefs = RestaurantChef::with('restaurant');

        if ($query !== null) {
            $chefs->where('restaurant_id', $query);
        }

        return $chefs->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('chef_image')) {
            $imageName = str_replace(' ', '_', $request->input('chef_name') . $request->input('chef_role')) . time() . '.' . $request->file('chef_image')->extension();
            $request->file('chef_image')->storeAs('public/restaurants/chefs', $imageName);
            return RestaurantChef::create([
                'chef_image' => $imageName,
                'chef_name' => $request->input('chef_name'),
                'chef_role' => $request->input('chef_role'),
                'restaurant_id' => $request->input('restaurant_id')
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
        return RestaurantChef::with('restaurant')->find($id);
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
        $chef = RestaurantChef::find($id);

        if ($request->hasFile('chef_image')) {
            $imageName = str_replace(' ', '_', $request->input('chef_name') . $request->input('chef_role')) . time() . '.' . $request->file('chef_image')->extension();
            $request->file('chef_image')->storeAs('public/restaurants/chefs', $imageName);
            $chef->chef_image = $imageName;
        }

        $chef->chef_name = $request->input('chef_name');
        $chef->chef_role = $request->input('chef_role');
        $chef->restaurant_id = $request->input('restaurant_id');
        $chef->save();

        return $chef;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RestaurantChef::destroy($id);
    }
}
