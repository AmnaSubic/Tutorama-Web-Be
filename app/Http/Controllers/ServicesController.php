<?php

namespace App\Http\Controllers;

use App\Services;
use App\Http\Resources\Services as ServicesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ServicesResource::collection(Services::all());
    }

    public function userServices()
    {
        return ServicesResource::collection(Services::all()->where('Tutor_ID', auth()->user()->getAuthIdentifier()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ServicesResource
     */
    public function store(Request $request)
    {
        $services = Services::create($request->all());

        return new ServicesResource($services);
    }

    /**
     * Display the specified resource.
     *
     * @param Services $services
     * @return void
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Services $services
     * @return void
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Services $services
     * @return void
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Services $services
     * @return void
     */
    public function destroy(Services $services)
    {
        //
    }
}
