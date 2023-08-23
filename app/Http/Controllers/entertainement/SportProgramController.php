<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\entertainement\SportProgram;
use Illuminate\Http\Request;

class SportProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query != null) {
            return SportProgram::where('visible', $query);
        }

        return SportProgram::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Handle image uploads for banner_image, home_team_logo, and away_team_logo
        if ($request->hasFile('banner_image')) {
            $request->file('banner_image')->store('public/entertainment/sports');
            $data['banner_image'] = $request->file('banner_image')->hashName();
        }

        if ($request->hasFile('home_team_logo')) {
            $request->file('home_team_logo')->store('public/entertainment/sports');
            $data['home_team_logo'] =  $request->file('home_team_logo')->hashName();
        }

        if ($request->hasFile('away_team_logo')) {
            $request->file('away_team_logo')->store('public/entertainment/sports');
            $data['away_team_logo'] = $request->file('away_team_logo')->hashName();
        }

        return SportProgram::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SportProgram::find($id);
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
        $sportProgram = SportProgram::find($id);

        $data = $request->all();

        if ($request->hasFile('banner_image')) {
            $request->file('banner_image')->store('public/entertainment/sports');
            $data['banner_image'] = $request->file('banner_image')->hashName();
        }

        if ($request->hasFile('home_team_logo')) {
            $request->file('home_team_logo')->store('public/entertainment/sports');
            $data['home_team_logo'] = $request->file('home_team_logo')->hashName();
        }

        if ($request->hasFile('away_team_logo')) {
            $request->file('away_team_logo')->store('public/entertainment/sports');
            $data['away_team_logo'] = $request->file('away_team_logo')->hashName();
        }

        return $sportProgram->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return SportProgram::destroy($id);
    }
}
