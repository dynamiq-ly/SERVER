<?php

namespace App\Http\Controllers\gym;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGymRequest;
use App\Models\gym\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gym::with('staff', 'equipements')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGymRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'timing-open' => $request->input('timing-open'),
            'timing-close' => $request->input('timing-close'),
            'reservation' => $request->input('reservation', false),
        ];

        if ($request->hasFile("image")) {
            $request->file('image')->store('public/gym/thumbnails');
            $data['image'] = $request->file('image')->hashName();
        }

        if ($request->hasFile("terms")) {
            $request->file('terms')->store('public/pdf/gym');
            $data['terms'] = $request->file('terms')->hashName();
        }

        return Gym::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gym::with('staff', 'equipements')->find($id);
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

        $gym = Gym::find($id);

        if ($request->hasFile("image")) {
            Storage::delete('public/pdf/gym/' . $gym->terms);
            $imagePath = $request->file('image')->store('public/gym/thumbnails');
            $gym->image = $imagePath;
        }

        if ($request->hasFile("terms")) {
            Storage::delete('public/pdf/gym/' . $gym->terms);
            $termsPath = $request->file('terms')->store('public/pdf/gym');
            $gym->terms = $termsPath;
        }

        $gym->name = $request->name;
        $gym->location = $request->location;
        $gym->description = $request->description;
        $gym->{'timing-open'} = $request->input('timing-open');
        $gym->{'timing-close'} = $request->input('timing-close');
        $gym->reservation = $request->reservation;

        $gym->save();

        return $gym;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Gym::destroy($id);
    }
}
