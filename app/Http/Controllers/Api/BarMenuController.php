<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarMenu;
use Illuminate\Http\Request;

class BarMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return BarMenu::where('bar_id', $id)->with('drinks')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('bar_menu_category_image')) {
            $request->file('bar_menu_category_image')->store('public/bars/menus');
            return BarMenu::create([
                'bar_menu_category' => $request->bar_menu_category,
                'bar_menu_category_image' => $request->bar_menu_category_image->hashName(),
                'bar_id' => $request->bar_id
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
        return BarMenu::with('drinks')->find($id);
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
        if ($request->hasFile('bar_menu_category_image')) {
            $request->file()->store('public/bars/menus');
            return BarMenu::find($id)->update([
                'bar_menu_category' => $request->bar_menu_category,
                'bar_menu_category_image' => $request->bar_menu_category_image->hashName(),
                'bar_id' => $request->bar_id
            ]);
        } else {
            return BarMenu::find($id)->update([
                'bar_menu_category' => $request->bar_menu_category,
                'bar_id' => $request->bar_id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarMenu::destroy($id);
    }
}
