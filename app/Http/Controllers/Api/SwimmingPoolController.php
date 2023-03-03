<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SwimmingPool;
use Illuminate\Http\Request;

class SwimmingPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SwimmingPool::all();
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
            $request->file('pool_image')->store('public/swimming-pool/thumbnails');
            return SwimmingPool::create([
                'pool_type' => $request->pool_type,
                'pool_image' => $request->file('pool_image')->hashName(),
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
        return SwimmingPool::find($id);
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
            $request->file('pool_image')->store('public/swimming-pool/thumbnails');
            return SwimmingPool::find($id)->update([
                'pool_type' => $request->pool_type,
                'pool_image' => $request->file('pool_image')->hashName(),
            ]);
        } else {
            return SwimmingPool::find($id)->update([
                'pool_type' => $request->pool_type,
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
        return SwimmingPool::destroy($id);
    }
}
