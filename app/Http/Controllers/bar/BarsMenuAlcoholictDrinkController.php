<?php

namespace App\Http\Controllers\bar;

use App\Http\Controllers\Controller;
use App\Models\bar\BarsAlcoholDrink;
use Illuminate\Http\Request;

class BarsMenuAlcoholictDrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query != null) {
            return BarsAlcoholDrink::with('features')->where('drink_id', $query)->get();
        }

        return BarsAlcoholDrink::with('features')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'slug',
            'size',
            'price',
            'small_price',
            'category',
            'type',
            'served_slug',
            'served_with',
            'preperation',
            'description',
            'drink_id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/bars/menu/alcohol');

            $data['image'] = $image->hashName();

            return BarsAlcoholDrink::create($data);
        }

        return response()->json([
            'message' => 'Please upload at least one image'
        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BarsAlcoholDrink::with('menu', 'features')->find($id);
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
        $bar = BarsAlcoholDrink::find($id);

        $data = $request->only([
            'name',
            'slug',
            'size',
            'price',
            'small_price',
            'category',
            'type',
            'served_slug',
            'served_with',
            'preperation',
            'description',
            'drink_id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/bars/menu/alcohol');

            $data['image'] = $image->hashName();
        }

        return $bar->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarsAlcoholDrink::destroy($id);
    }
}
