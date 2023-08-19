<?php

namespace App\Http\Controllers\bar;

use App\Http\Controllers\Controller;
use App\Models\bar\BarsAlcoholDrinkFeature;
use Illuminate\Http\Request;

class BarsMenuAlcoholictDrinkFeaturesController extends Controller
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
            return BarsAlcoholDrinkFeature::where('drink_id', $query)->get();
        }

        return BarsAlcoholDrinkFeature::all();
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
            'label',
            'value',
            'drink_id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/bars/menu/alcohol/features');

            $data['image'] = $image->hashName();
        }
        return BarsAlcoholDrinkFeature::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BarsAlcoholDrinkFeature::with('alcohol')->find($id);
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
        $feature = BarsAlcoholDrinkFeature::find($id);

        $data = $request->only([
            'label',
            'value',
            'drink_id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/bars/menu/alcohol/features');

            $data['image'] = $image->hashName();
        }

        if ($request->input('delete_image') != null) {
            $data['image'] = null;
        }

        return $feature->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarsAlcoholDrinkFeature::destroy($id);
    }
}
