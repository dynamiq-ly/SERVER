<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bar;
use Illuminate\Http\Request;

class BarController extends Controller
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
            return Bar::with('images', 'menus')->where('bar_status', 1)->get();
        else if ($bool == -1)
            return Bar::with('images', 'menus')->where('bar_status', 0)->get();
        else
            if ($bool == 0)
            return Bar::with('images', 'menus')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasfile('images')) {
            $bar = Bar::create(
                $request->only(
                    'bar_name',
                    'bar_location',
                    'bar_open_time',
                    'bar_description',
                    'bar_closed_days',
                    'bar_phone_number',
                    'bar_status',
                    'bar_can_book',
                    'bar_booking_capacity'
                )
            );

            foreach ($request->file('images') as $image) {
                $image->store('public/bars');
                $bar->images()->create([
                    'image' => $image->hashName(),
                    'bar_id' => $bar->id
                ]);
            }
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
        return Bar::with('images', 'menus')->find($id);
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
        return Bar::destroy($id);
    }
}
