<?php

namespace App\Http\Controllers\policies\hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelPolicyRequest;
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
    public function store(StoreHotelPolicyRequest $request)
    {

        if($request->hasFile('file')) {
            $request->file('file')->store('public/pdf/policies');

            return HotelPolicies::create([
                'title' => $request->title,
                'subTitle' => $request->subTitle,
                'filePath' => $request->file('file')->hashName(),
                'type' => $request->type,
            ]);
        }
        return response()->json(['message' => 'No File uploaded'], 400);
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
        $policy = HotelPolicies::findOrFail($id);

        $policy->title = $request->title;
        $policy->subTitle = $request->subTitle;
        $policy->type = $request->type;

        if ($request->hasFile('file')) {
            // Delete the old PDF file
            Storage::delete('public/pdf/policies/' . $policy->filePath);

            // Store the new PDF file
            $pdfPath = $request->file('file')->store('public/pdf/policies');
            $policy->filePath = $request->file('file')->hashName();
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
