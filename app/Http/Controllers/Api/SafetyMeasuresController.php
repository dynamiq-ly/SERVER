<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SafetyMeasuresRequest;
use App\Models\SafetyMeasures;
use Illuminate\Http\Request;

class SafetyMeasuresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SafetyMeasures::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SafetyMeasuresRequest $request)
    {
        return SafetyMeasures::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SafetyMeasures  $safetyMeasures
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return SafetyMeasures::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        return SafetyMeasures::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SafetyMeasures  $safetyMeasures
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return SafetyMeasures::destroy($id);
    }
}
