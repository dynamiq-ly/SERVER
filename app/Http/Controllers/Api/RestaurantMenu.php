<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantFoodMenuCategory;
use Illuminate\Http\Request;

class RestaurantMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestaurantFoodMenuCategory::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function indexFood($id)
    {
        return RestaurantFoodMenuCategory::where('restaurant_id',  $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFood(Request $request)
    {
        if ($request->hasFile('restaurant_food_image')) {
            $request->file('restaurant_food_image')->store('public/restaurants/menu/food/thumbnails');
            return RestaurantFoodMenuCategory::create([
                'restaurant_food_category' => $request->restaurant_food_category,
                'restaurant_food_image' => $request->restaurant_food_image->hashName(),
                'restaurant_id' => $request->restaurant_id
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFood($id)
    {
        return RestaurantFoodMenuCategory::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFood(Request $request, $id)
    {
        if ($request->hasFile('restaurant_food_image')) {
            $request->file('restaurant_food_image')->store('public/restaurants/menu/food/thumbnails');
            return RestaurantFoodMenuCategory::find($id)->update([
                'restaurant_food_category' => $request->restaurant_food_category,
                'restaurant_food_image' => $request->restaurant_food_image->hashName(),
                'restaurant_id' => $request->restaurant_id
            ]);
        } else {
            return RestaurantFoodMenuCategory::find($id)->update([
                'restaurant_food_category' => $request->restaurant_food_category,
                'restaurant_id' => $request->restaurant_id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFood($id)
    {
        return RestaurantFoodMenuCategory::destroy($id);
    }
}
