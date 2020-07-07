<?php

namespace App\Http\Controllers;

use App\AvailableTimes;
use App\Http\Resources\AvailableTimes as ATResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class AvailableTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() {
        return ATResource::collection(AvailableTimes::all());
    }

    /**
     * Display available times for authorized user.
     *
     * @return AnonymousResourceCollection
     */
    public function authUserAvailableTimes() {
        return ATResource::collection(AvailableTimes::all()->where('Tutor_ID', auth()->user()->getAuthIdentifier()));
    }

    /**
     * Display available times for selected tutor.
     *
     * @param int $id
     * @return AnonymousResourceCollection
     */
    public function userAvailableTimes($id) {
        return ATResource::collection(AvailableTimes::all()->where('Tutor_ID', $id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ATResource
     */
    public function store(Request $request) {
        $at = AvailableTimes::create($request->all());
        return new ATResource($at);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $day = $request->input('Day');
        $start = $request->input('Start_Time');
        $end = $request->input('End_Time');
        DB::table('available_times')
            -> where('available_times.Available_Time_ID', $id)
            -> update([
                'available_times.Day' => $day,
                'available_times.Start_Time' => $start,
                'available_times.End_Time' => $end
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        DB::table('available_times')
            -> where('available_times.Available_Time_ID', $id)
            -> delete();
    }
}
