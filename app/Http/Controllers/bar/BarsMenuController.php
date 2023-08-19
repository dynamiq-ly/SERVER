<?php

namespace App\Http\Controllers\bar;

use App\Http\Controllers\Controller;
use App\Models\bar\BarsMenu;
use Illuminate\Http\Request;

class BarsMenuController extends Controller
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
            return BarsMenu::with('soft', 'alcohol.features')->where('bar_id', $query)->get();
        }

        return BarsMenu::with('soft', 'alcohol.features')->get();
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
            $request->file('image')->store('public/bars/menu');

            return BarsMenu::create([
                'name' => $request->name,
                'image' => $request->file('image')->hashName(),
                'type' => $request->type,
                'categories' => $request->categories,
                'bar_id' => $request->bar_id,
            ]);
        }
        return response()->json([
            'message' => 'Image not found',
        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return BarsMenu::with('soft', 'alcohol.features', 'bar')->find($id);
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
        $bar = BarsMenu::find($id);

        $data = $request->only([
            'name',
            'type',
            'categories',
            'bar_id',
        ]);

        // Handle image update if provided
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageFile->store('public/bars/menu');

            $data['image'] = $imageFile->hashName();
        }

        return $bar->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarsMenu::destroy($id);
    }
}
