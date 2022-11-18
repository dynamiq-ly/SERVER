<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantDrinkMenuAlchohol;
use App\Models\RestaurantDrinkMenuCategory;
use App\Models\RestaurantDrinkMenuSoft;
use App\Models\RestaurantFoodMenuCategory;
use App\Models\RestaurantFoodMenuList;
use App\Models\RestauranttDrinkMenuSoft;
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
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        return RestaurantDrinkMenuCategory::with('softdrinks', 'alcoholdrinks')->get();
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
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function indexDrink($id)
    {
        return RestaurantDrinkMenuCategory::where('restaurant_id',  $id)->with('softdrinks', 'alcoholdrinks')->get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDrink(Request $request)
    {
        if ($request->hasFile('restaurant_drink_image')) {
            $request->file('restaurant_drink_image')->store('public/restaurants/menu/drink/thumbnails');
            return RestaurantDrinkMenuCategory::create([
                'restaurant_drink_category' => $request->restaurant_drink_category,
                'restaurant_drink_image' => $request->restaurant_drink_image->hashName(),
                'restaurant_drink_type' => $request->restaurant_drink_type,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDrink($id)
    {
        return RestaurantDrinkMenuCategory::find($id);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDrink(Request $request, $id)
    {
        if ($request->hasFile('restaurant_drink_image')) {
            $request->file('restaurant_drink_image')->store('public/restaurants/menu/food/thumbnails');
            return RestaurantDrinkMenuCategory::find($id)->update([
                'restaurant_drink_category' => $request->restaurant_food_category,
                'restaurant_drink_image' => $request->restaurant_drink_image->hashName(),
                'restaurant_drink_type' => $request->restaurant_drink_type,
                'restaurant_id' => $request->restaurant_id
            ]);
        } else {
            return RestaurantDrinkMenuCategory::find($id)->update([
                'restaurant_drink_category' => $request->restaurant_food_category,
                'restaurant_drink_type' => $request->restaurant_drink_type,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDrink($id)
    {
        return RestaurantDrinkMenuCategory::destroy($id);
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

    /**
     * soft drinks
     */
    public function indexSoftDrinks()
    {
        return RestaurantDrinkMenuSoft::all();
    }

    public function indexSoftDrink($id)
    {
        return RestaurantDrinkMenuSoft::where('restaurant_soft_drink_id', $id)->get();
    }

    public function storeSoftDrink(Request $request)
    {
        return RestaurantDrinkMenuSoft::create($request->all());
    }

    public function updateSoftDrink($id, Request $request)
    {
        return RestaurantDrinkMenuSoft::find($id)->update($request->all());
    }

    /**
     * alcohol drinks
     */

    public function indexAlcoholDrinks()
    {
        return RestaurantDrinkMenuAlchohol::all();
    }

    public function indexAlcoholDrink($id)
    {
        return RestaurantDrinkMenuAlchohol::where('restaurant_alcohol_id', $id)->get();
    }

    public function findAlcoholDrink($id)
    {
        return RestaurantDrinkMenuAlchohol::find($id);
    }

    public function storeAlcoholDrink(Request $request)
    {
        if ($request->hasFile('drink_alcohol_image')) {
            $request->file('drink_alcohol_image')->store('public/restaurants/menu/drink/bottles');
            return RestaurantDrinkMenuAlchohol::create([
                'drink_alcohol_name' => $request->drink_alcohol_name,
                'drink_alcohol_type' => $request->drink_alcohol_type,
                'drink_alcohol_bottle_size' => $request->drink_alcohol_bottle_size,
                'drink_alcohol_bottle_price' => $request->drink_alcohol_bottle_price,
                'drink_alcohol_glass_size' => $request->drink_alcohol_glass_size,
                'drink_alcohol_glass_price' => $request->drink_alcohol_glass_price,
                'drink_alcohol_description' => $request->drink_alcohol_description,
                'drink_alcohol_origin' => $request->drink_alcohol_origin,
                'drink_alcohol_year' => $request->drink_alcohol_year,
                'drink_alcohol_ingredient' => $request->drink_alcohol_ingredient,
                'drink_alcohol_percentage' => $request->drink_alcohol_percentage,
                'drink_alcohol_image' => $request->drink_alcohol_image->hashName(),
                'restaurant_alcohol_id' => $request->restaurant_alcohol_id,
            ]);
        }
    }
}
