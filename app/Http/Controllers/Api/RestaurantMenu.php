<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantFoodMenuCategory;
use App\Models\RestaurantFoodMenuList;
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
        return RestaurantFoodMenuCategory::with('dishes')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function indexFood($id)
    {
        return RestaurantFoodMenuCategory::where('restaurant_id',  $id)->with('dishes')->get();
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


    /**
     * dishes
     */

    public function indexDish()
    {
        return RestaurantFoodMenuList::all();
    }

    public function indexFoodDish($id)
    {
        return RestaurantFoodMenuList::where('restaurant_food_categories_id', $id)->get();
    }

    public function storeFoodDish(Request $request)
    {
        if ($request->hasFile('dish_image')) {
            $request->file('dish_image')->store('public/restaurants/menu/food/dishes');
            return RestaurantFoodMenuList::create([
                'dish_name' => $request->dish_name,
                'dish_price' => $request->dish_price,
                'dish_summary' => $request->dish_summary,
                'dish_discount' => $request->dish_discount,
                'dish_wait_time' => $request->dish_wait_time,
                'dish_ingredient' => $request->dish_ingredient,
                'dish_description' => $request->dish_description,
                'dish_image' => $request->dish_image->hashName(),
                'restaurant_food_categories_id' => $request->restaurant_food_categories_id
            ]);
        }
    }
}
