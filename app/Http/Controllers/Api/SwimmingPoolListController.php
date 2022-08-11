<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SwimmingPoolLists;
use Illuminate\Http\Request;

class SwimmingPoolListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SwimmingPoolLists::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchByPoolType($id)
    {
        return SwimmingPoolLists::where('pool_id', $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('pool_image')) {
            $request->file('pool_image')->store('public/swimming-pool/images');
            return SwimmingPoolLists::create([
                'pool_name' => $request->pool_name,
                'pool_image' => $request->file('pool_image')->hashName(),
                'pool_capacity' => $request->pool_capacity,
                'pool_description' => $request->pool_description,
                'pool_status' => $request->pool_status,
                'pool_id' => $request->pool_id
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
        return SwimmingPoolLists::find($id);
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
        if ($request->hasFile('pool_image')) {
            $request->file('pool_image')->store('public/swimming-pool/images');
            return SwimmingPoolLists::find($id)->update([
                'pool_name' => $request->pool_name,
                'pool_image' => $request->file('pool_image')->hashName(),
                'pool_capacity' => $request->pool_capacity,
                'pool_description' => $request->pool_description,
                'pool_status' => $request->pool_status,
                'pool_id' => $request->pool_id
            ]);
        } else {
            return SwimmingPoolLists::find($id)->update([
                'pool_name' => $request->pool_name,
                'pool_capacity' => $request->pool_capacity,
                'pool_description' => $request->pool_description,
                'pool_status' => $request->pool_status,
                'pool_id' => $request->pool_id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return SwimmingPoolLists::destroy($id);
    }
}
