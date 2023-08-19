<?php

namespace App\Http\Controllers\bar;

use App\Http\Controllers\Controller;
use App\Models\bar\BarsStaff;
use Illuminate\Http\Request;

class BarsStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->query('query');

        if ($query != null) {
            return BarsStaff::with('bar')->where('bar_id', $query)->get();
        }

        return BarsStaff::with('bar')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {

            $imageFile = $request->file('image');
            $imageFile->store('public/images/bars/staff'); // You might want to change the directory

            $data = $request->only([
                'name',
                'position',
                'bar_id',
            ]);

            $data['image'] = $imageFile->hashName();

            return BarsStaff::create($data);
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
        return BarsStaff::with('bar')->find($id);
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
        // Find the existing BarsStaff record by ID
        $staff = BarsStaff::find($id);

        // Extract the input data from the request
        $data = $request->only([
            'name',
            'position',
            'bar_id',
        ]);

        // Handle image update if provided
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFile->store('public/bars/staff');

            $data['image'] = $imageFile->hashName();
        }

        // Update the BarsStaff record with the modified data
        return $staff->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarsStaff::destroy($id);
    }
}
