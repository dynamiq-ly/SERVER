<?php

namespace App\Http\Controllers\gym;

use App\Http\Controllers\Controller;
use App\Models\gym\GymEquipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GymEquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $gyms = GymEquipement::with('gym');

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
            $request->file('image')->store('public/gym/equipements');

            return GymEquipement::create([
                'name' => $request->input('name'),
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
        return GymEquipement::with('gym')->find($id);
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
        $gymEquipement = GymEquipement::find($id);

        $data = [
            'name' => $request->input('name', $gymEquipement->name),
            'gym_id' => $request->input('gym_id', $gymEquipement->gym_id),
        ];

        if ($request->hasFile('image')) {
            Storage::delete('public/gym/equipements/' . $gymEquipement->image);
            $request->file('image')->store('public/gym/equipements');
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
        return GymEquipement::destroy($id);
    }
}
