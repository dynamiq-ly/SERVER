<?php

namespace App\Http\Controllers\Pension;

use App\Http\Controllers\Controller;
use App\Models\PensionUpgrade;
use Illuminate\Http\Request;

class PensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PensionUpgrade::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('pension_image')) {
            $request->file('pension_image')->store('public/rooms/pension');
            return PensionUpgrade::create([
                'pension_name' => $request->pension_name,
                'pension_price' => $request->pension_price,
                'pension_price_kids' => $request->pension_price_kids,
                'pension_description' => $request->pension_description,
                'pension_image' => $request->file('pension_image')->hashName(),
            ]);
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
        return PensionUpgrade::find($id);
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
        $pension = PensionUpgrade::find($id);

        if ($request->hasFile('pension_image')) {
            $request->file('pension_image')->store('public/rooms/pension');
            $pension->pension_image = $request->file('pension_image')->hashName();
        }

        $pension->update([
            'pension_name' => $request->pension_name,
            'pension_price' => $request->pension_price,
            'pension_price_kids' => $request->pension_price_kids,
            'pension_description' => $request->pension_description,
        ]);

        return $pension;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PensionUpgrade::destroy($id);
    }
}
