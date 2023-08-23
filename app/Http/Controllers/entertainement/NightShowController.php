<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\entertainement\NightShow;
use Illuminate\Http\Request;

class NightShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $days = NightShow::with('timing');

        if ($query !== null) {
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
        $nightShowData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'genre' => $request->input('genre'),
            'visible' => $request->input('visible'),
            'joinable' => $request->input('joinable'),
            'youtube_link' => $request->input('youtube_link'),
            'website_link' => $request->input('website_link'),
            'host_name' => $request->input('host_name'),
            'host_role' => $request->input('host_role'),
            'host_description' => $request->input('host_description'),
        ];

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/entertainment/nights');
            $nightShowData['image'] = $request->file('image')->hashName();

            if ($request->hasFile('host_image')) {
                $request->file('host_image')->store('public/entertainment/nights/shows');
                $nightShowData['host_image'] = $request->file('host_image')->hashName();
            } else {
                $nightShowData['host_image'] = null; // Set host_image to null if it's not provided
            }

            return NightShow::create($nightShowData);
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
        return NightShow::with('timing')->find($id);
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
        $nightShow = NightShow::findOrFail($id);

        $nightShowData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'genre' => $request->input('genre'),
            'visible' => $request->input('visible'),
            'joinable' => $request->input('joinable'),
            'youtube_link' => $request->input('youtube_link'),
            'website_link' => $request->input('website_link'),
            'host_name' => $request->input('host_name'),
            'host_role' => $request->input('host_role'),
            'host_description' => $request->input('host_description'),
        ];

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/entertainment/nights');
            $nightShowData['image'] = $request->file('image')->hashName();
        }

        if ($request->hasFile('host_image')) {
            $request->file('host_image')->store('public/entertainment/nights/shows');
            $nightShowData['host_image'] = $request->file('host_image')->hashName();
        }

        return $nightShow->update($nightShowData);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return NightShow::destroy($id);
    }
}
