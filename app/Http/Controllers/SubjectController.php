<?php

namespace App\Http\Controllers;

use App\Subjects;
use App\Http\Resources\Subjects as SubjectsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return SubjectsResource::collection(Subjects::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SubjectsResource
     */
    public function store(Request $request)
    {
        $subjects = Subjects::create($request->all());

        return new SubjectsResource($subjects);
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
