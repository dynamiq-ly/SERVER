<?php

namespace App\Http\Controllers\entertainement;

use App\Http\Controllers\Controller;
use App\Models\EntertainementTiming;

use Illuminate\Http\Request;

class EntertainementController extends Controller
{
    /**
     * Display the number of total timing for the current week.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalTiming()
    {
        return EntertainementTiming::count();
    }
}
