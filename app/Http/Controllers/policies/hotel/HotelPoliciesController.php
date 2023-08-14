<?php

namespace App\Http\Controllers\policies\hotel;

use App\Http\Controllers\Controller;
use App\Models\policies\hotel\HotelPolicies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelPoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $policy = $request->input('policy');

        if ($policy !== null) {
            return HotelPolicies::where('type', $policy)->get();
        }

        return HotelPolicies::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validation = $request->validate([
            'title' => 'required|string|max:100',
            'subTitle' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240', // Assuming max file size is 10MB
            'type' => 'required|in:APPLICATION,HOTEL',
        ]);

        return HotelPolicies::create([
            'title' => $request->input('title'),
            'subTitle' => $request->input('subTitle'),
            'filePath' => $request->file('file')->store('public/pdf/policies'),
            'type' => $request->input('type'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return HotelPolicies::find($id);
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

        // Validate the incoming request data
        $validation = $request->validate([
            'title' => 'required|string|max:100',
            'subTitle' => 'required|string|max:255',
            'file' => 'file|mimes:pdf|max:10240', // Assuming max file size is 10MB
            'type' => 'required|in:APPLICATION,HOTEL',
        ]);

        $policy = HotelPolicies::find($id);

        // Update the fields
        $policy->title = $request->input('title');
        $policy->subTitle = $request->input('subTitle');
        $policy->type = $request->input('type');

        // Check if a new PDF file is uploaded
        if ($request->hasFile('file')) {
            // Delete the old PDF file
            Storage::delete($policy->filePath);

            // Store the new PDF file
            $pdfPath = $request->file('file')->store('public/pdf/policies');
            $policy->filePath = $pdfPath;
        }

        $policy->save();
        return $policy;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return HotelPolicies::destroy($id);
    }
}
