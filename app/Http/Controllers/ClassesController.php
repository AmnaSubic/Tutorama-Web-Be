<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Resources\Classes as ClassesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ClassesResource::collection(Classes::all());
    }

    /**
     * Display classes for the authorized student.
     *
     * @return Collection
     */
    public function authStudentClasses() {
        return DB::table('classes')
            -> join('services', 'classes.Service_ID', 'services.Service_ID')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> join('users', 'services.Tutor_ID', 'users.User_ID')
            -> where('classes.Student_ID', '=', auth()->user()->getAuthIdentifier())
            -> select('classes.*', 'services.*', 'subjects.Subject_Name', 'users.First_Name', 'users.Last_Name', 'users.Town', 'users.Country')
            -> get();
    }

    /**
     * Display classes for the authorized tutor.
     *
     * @return Collection
     */
    public function authTutorClasses() {
        return DB::table('classes')
            -> join('services','classes.Service_ID','services.Service_ID')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> where('services.Tutor_ID', '=', auth()->user()->getAuthIdentifier())
            -> select('classes.*', 'services.*', 'subjects.Subject_Name')
            -> get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ClassesResource
     */
    public function store(Request $request)
    {
        $classes = Classes::create($request->all());

        return new ClassesResource($classes);
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
