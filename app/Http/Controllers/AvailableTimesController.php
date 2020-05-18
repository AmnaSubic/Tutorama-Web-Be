<?php

namespace App\Http\Controllers;

use App\AvailableTimes;
use App\Http\Resources\AvailableTimes as ATResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
