<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantReservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

        // Convert start and end times to Carbon objects
        $startTime = Carbon::createFromTimestamp($request->input('reservation_date_time_start'));
        $endTime = Carbon::createFromTimestamp($request->input('reservation_date_time_end'));

        // Check if requested reservation overlaps with any existing reservations
        $overlappingReservations = $restaurant->reservations->filter(function ($reservation) use ($startTime, $endTime, $request) {
            return ($startTime->gte($reservation->reservation_date_time_start) && $startTime->lt($reservation->reservation_date_time_end)) ||
                ($endTime->gt($reservation->reservation_date_time_start) && $endTime->lte($reservation->reservation_date_time_end)) ||
                ($startTime->lte($reservation->reservation_date_time_start) && $endTime->gte($reservation->reservation_date_time_end)) &&
                ($reservation->user_id !== $request->input('user_id') || $reservation->restaurant_id !== $request->input('restaurant_id'));
        });

        if ($overlappingReservations->isNotEmpty()) {
            return response()->json([
                'message' => 'The requested reservation overlaps with an existing reservation',
            ], 400);
        }

        // Check if the requested reservation exceeds the capacity at any hour
        $hours = CarbonPeriod::create($startTime, $endTime);
        $maxCapacity = $restaurant->booking->booking_capacity;
        foreach ($hours as $hour) {
            $reservationsAtHour = $restaurant->reservations->filter(function ($reservation) use ($hour) {
                return $hour->eq(Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reservation_date_time_start)->hour);
            });
            $totalCapacityAtHour = $reservationsAtHour->sum('reservation_number_of_people');
            if ($totalCapacityAtHour + $request->input('reservation_number_of_people') > $maxCapacity) {
                return response()->json([
                    'message' => 'The requested reservation exceeds the capacity at ' . $hour->format('H:i'),
                ], 400);
            }
        }

        // Create the reservation
        $reservation = new RestaurantReservation;
        $reservation->reservation_name = $request->input('reservation_name');
        $reservation->reservation_description = $request->input('reservation_description');
        $reservation->reservation_date_time_start = $startTime;
        $reservation->reservation_date_time_end = $endTime;
        $reservation->reservation_number_of_people = $request->input('reservation_number_of_people');
        $reservation->user_id = $request->input('user_id');
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->save();

        return $reservation;
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
