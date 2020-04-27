<?php

namespace App\Http\Controllers;

use App\Reviews;
use App\Http\Resources\Reviews as ReviewsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ReviewsResource::collection(Reviews::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ReviewsResource
     */
    public function store(Request $request)
    {
        $reviews = Reviews::create($request->all());

        return new ReviewsResource($reviews);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
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
