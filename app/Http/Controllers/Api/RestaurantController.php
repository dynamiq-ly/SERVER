<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantRegulation;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $bool
     * @return \Illuminate\Http\Response
     */
    public function index($bool = null)
    {
        if ($bool == 1)
            return Restaurant::with('images', 'chefs', 'regulations', 'schedule', 'foodCategories', 'drinkCategories')->where('restaurant_status', 1)->get();
        else if ($bool == -1)
            return Restaurant::with('images', 'chefs', 'regulations', 'schedule', 'foodCategories', 'drinkCategories')->where('restaurant_status', 0)->get();
        else 
            if ($bool == 0)
            return Restaurant::with('images', 'chefs', 'regulations', 'schedule', 'foodCategories', 'drinkCategories')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::create(
            $request->only(
                'restaurant_name',
                'restaurant_website',
                'restaurant_descripton',
                'restaurant_opens',
                'restaurant_closes',
                'restaurant_location',
                'restaurant_speciality',
                'restaurant_status',
                'restaurant_capacity',
                'restaurant_can_book',
                'restaurant_booked_capacity'
            )
        );

        // $restaurant->regulations()->create([
        //     'restaurant_id' => $restaurant->id,
        //     'restaurant_regulations_name' => $request->restaurant_regulations_name,
        //     'restaurant_regulations_description' => $request->restaurant_regulations_description,
        // ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image->store('public/restaurants');
                $restaurant->images()->create([
                    'image' => $image->hashName(),
                    'restaurant_id' => $restaurant->id
                ]);
            }
        }

        if ($request->hasFile('restaurant_chef_exec_image') || $request->hasFile('restaurant_chef_image')) {

            $request->file('restaurant_chef_exec_image')->store('public/restaurants/chefs');
            $request->file('restaurant_chef_image')->store('public/restaurants/chefs');

            $restaurant->chefs()->create([
                'restaurant_id' => $restaurant->id,
                'restaurant_chef_exec_name' => $request->restaurant_chef_exec_name,
                'restaurant_chef_name' => $request->restaurant_chef_name,
                'restaurant_chef_exec_image' => $request->file('restaurant_chef_exec_image')->hashName(),
                'restaurant_chef_image' => $request->file('restaurant_chef_image')->hashName(),
            ]);
        }


        $restaurant->schedule()->create([
            'sunday' => $request->sunday,
            'monday' => $request->monday,
            'tuesday' => $request->tuesday,
            'wednesday' => $request->wednesday,
            'thursday' => $request->thursday,
            'friday' => $request->friday,
            'saturday' => $request->saturday,
            'restaurant_id' => $restaurant->id
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
        return Restaurant::with('images', 'chefs', 'regulations', 'schedule', 'foodCategories', 'drinkCategories')->find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Restaurant::destroy($id);
    }
}
