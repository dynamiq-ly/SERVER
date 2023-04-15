<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $restaurants = Restaurant::with('images', 'servings', 'booking', 'chefs', 'specialities', 'foodCatalog', 'drinkCatalog', 'schedule');

        if ($status !== null) {
            $restaurants->where('isVisible', $status);
        }

        return $restaurants->get();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('images')) {

            $restaurant = Restaurant::create($request->only([
                'restaurant_name',
                'restaurant_description',
                'restaurant_email',
                'restaurant_phone',
                'restaurant_website',
                'restaurant_location',
                'restaurant_position',
                'isVisible'
            ]));

            /* image handling */
            foreach ($request->file('images') as $image) {
                $imageName = str_replace(' ', '_', $restaurant->restaurant_name) . time() . '.' . $image->extension();
                $image->storeAs('public/restaurants', $imageName);
                $restaurant->images()->create([
                    'image' => $imageName,
                    'image_description' => $request->input('image_description'),
                    'restaurant_id' => $restaurant->id
                ]);
            }

            /* booking handling */
            $restaurant->booking()->create([
                'can_book' => $request->input('can_book'),
                'booking_capacity' => $request->input('booking_capacity'),
                'booking_terms' => $request->input('booking_terms'),
                'restaurant_id' => $restaurant->id,
            ]);

            /* weekly schedule */
            $restaurant->schedule()->create([
                'isBuffet' => $request->input('isBuffet'),
                'monday' => $request->input('monday'),
                'tuesday' => $request->input('tuesday'),
                'wednesday' => $request->input('wednesday'),
                'thursday' => $request->input('thursday'),
                'friday' => $request->input('friday'),
                'saturday' => $request->input('saturday'),
                'sunday' => $request->input('sunday'),
                'restaurant_id' => $restaurant->id,
            ]);

            return $restaurant;
        }
        return response()->json(['message' => 'No images found'], 400);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurant::with('images', 'servings', 'booking', 'chefs', 'specialities', 'foodCatalog', 'drinkCatalog', 'schedule')->find($id);
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
        $restaurant = Restaurant::find($id);

        $restaurant->update($request->only([
            'restaurant_name',
            'restaurant_description',
            'restaurant_email',
            'restaurant_phone',
            'restaurant_website',
            'restaurant_location',
            'restaurant_position',
            'isVisible'
        ]));

        /* image handling */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = str_replace(' ', '_', $restaurant->restaurant_name) . time() . '.' . $image->extension();
                $image->storeAs('public/restaurants', $imageName);
                $restaurant->images()->create([
                    'image' => $imageName,
                    'image_description' => $request->input('image_description'),
                    'restaurant_id' => $restaurant->id
                ]);
            }
        }

        $restaurant->booking()->update([
            'can_book' => $request->input('can_book'),
            'booking_capacity' => $request->input('booking_capacity'),
            'booking_terms' => $request->input('booking_terms'),
            'restaurant_id' => $restaurant->id,
        ]);

        /* weekly schedule */

        $restaurant->schedule()->update([
            'isBuffet' => $request->input('isBuffet'),
            'monday' => $request->input('monday'),
            'tuesday' => $request->input('tuesday'),
            'wednesday' => $request->input('wednesday'),
            'thursday' => $request->input('thursday'),
            'friday' => $request->input('friday'),
            'saturday' => $request->input('saturday'),
            'sunday' => $request->input('sunday'),
            'restaurant_id' => $restaurant->id,
        ]);


        return $restaurant;
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
