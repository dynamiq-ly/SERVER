<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $query = $request->input('query');
        $reservations = RestaurantReservation::with('restaurant', 'user');

        if ($query !== null) {
            $reservations->where('restaurant_id', $query);
        }

        return $reservations->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::with("booking", 'reservations')->find($request->input('restaurant_id'));

        if (($restaurant->booking->booking_capacity - $restaurant->reservations->count) < $request->input('reservation_number_of_people')) {
            return response()->json([
                'message' => 'The number of people exceeds the capacity of the restaurant',
            ], 400);
        }

        return RestaurantReservation::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return RestaurantReservation::with('restaurant', 'user')->find($id);
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
        $restaurant = Restaurant::with("booking")->find($request->input('restaurant_id'));

        if (($restaurant->booking->booking_capacity - $restaurant->reservations->count) < $request->input('reservation_number_of_people')) {
            return response()->json([
                'message' => 'The number of people exceeds the capacity of the restaurant',
            ], 400);
        }

        $reservation = RestaurantReservation::find($id);
        $reservation->update($request->all());

        return $reservation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return RestaurantReservation::destroy($id);
    }
}
