<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;


class DocsController extends Controller
{

    /**
     * returns an array of map in our api
     */
    public function show()
    {
        $routes = array("users", "measures", "reminders", "activities", "entertainement");
        return view('docs', compact('routes'));
    }
}
