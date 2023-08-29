<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\entertainement\DayActivity;
use Illuminate\Http\Request;

class DayActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $days = DayActivity::with('timing');

        if ($query != null) {
            $days = $days->where('visible', $query);
        }

        return $days->get();
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
            $request->file('image')->store('public/entertainment/days');
            return DayActivity::create([
                'image' => $request->file('image')->hashName(),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'visible' => $request->input('visible'),
                'joinable' => $request->input('joinable'),
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
        return DayActivity::with('timing')->find($id);
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

        $dayActivity = DayActivity::find($id);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'visible' => $request->input('visible'),
            'joinable' => $request->input('joinable'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/entertainment/days');
            $data['image'] = $request->file('image')->hashName();
        }

        $dayActivity->update($data);

        return $dayActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DayActivity::destroy($id);
    }
}
