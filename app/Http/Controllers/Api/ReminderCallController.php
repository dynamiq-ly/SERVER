<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderCallRequest;
use App\Models\ReminderCall;
use Illuminate\Http\Request;

class ReminderCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReminderCall::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReminderCallControllerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReminderCallRequest $request)
    {
        return ReminderCall::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReminderCallController  $reminderCallController
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return ReminderCall::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReminderCallControllerRequest  $request
     * @param  \App\Models\ReminderCallController  $reminderCallController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        return ReminderCall::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReminderCallController  $reminderCallController
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return ReminderCall::destroy($id);
    }
}
