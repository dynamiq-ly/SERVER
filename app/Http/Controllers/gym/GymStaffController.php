<?php

namespace App\Http\Controllers\gym;

use App\Http\Controllers\Controller;
use App\Models\gym\GymStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GymStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $gyms = GymStaff::with('gym');

        if ($query !== null) {
            $gyms->where('gym_id', $query);
        }

        return $gyms->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $request->file('image')->store('public/gym/staffs');

            return GymStaff::create([
                'name' => $request->input('name'),
                'job_title' => $request->input('job_title'),
                'image' => $request->file('image')->hashName(),
                'gym_id' => $request->input('gym_id'),
            ]);
        }
        return response()->json(['message' => 'The image field is required'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GymStaff::with('gym')->find($id);
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
        $gymEquipement = GymStaff::find($id);

        $data = [
            'name' => $request->input('name', $gymEquipement->name),
            'job_title' => $request->input('job_title', $gymEquipement->job_title),
            'gym_id' => $request->input('gym_id', $gymEquipement->gym_id),
        ];

        if ($request->hasFile('image')) {
            Storage::delete('public/gym/staffs/' . $gymEquipement->image);
            $request->file('image')->store('public/gym/staffs');
            $data['image'] = $request->file('image')->hashName();
        }

        return $gymEquipement->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return GymStaff::destroy($id);
    }
}
