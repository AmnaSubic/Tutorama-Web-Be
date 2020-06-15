<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Resources\Classes as ClassesResource;
use Illuminate\Http\JsonResponse;
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
     * Display classes for the authorized user.
     *
     * @return Collection
     */
    public function authClasses() {
        $isTutor = DB::table('users')
            -> where('User_ID', auth()->user()->getAuthIdentifier())
            -> value('Is_Tutor');
        if ($isTutor == 0)
        return DB::table('classes')
            -> join('services', 'classes.Service_ID', 'services.Service_ID')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> where('classes.Student_ID', '=', auth()->user()->getAuthIdentifier())
            -> select('classes.Class_ID', 'classes.Date', 'classes.Start_at', 'classes.End_at', 'classes.Status',
                'services.Service_Level', 'subjects.Subject_Name')
            -> orderByDesc('classes.Date')
            -> get();
        else return DB::table('classes')
            -> join('services','classes.Service_ID','services.Service_ID')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> where('services.Tutor_ID', '=', auth()->user()->getAuthIdentifier())
            -> select('classes.Class_ID', 'classes.Date', 'classes.Start_at', 'classes.End_at', 'classes.Status',
                'services.Service_Level', 'subjects.Subject_Name')
            -> orderByDesc('classes.Date')
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
     * @return JsonResponse
     */
    public function show($id)
    {
        $isTutor = DB::table('users')
            -> where('User_ID', auth()->user()->getAuthIdentifier())
            -> value('Is_Tutor');
        if ($isTutor == 0)
            $class = DB::table('classes')
                -> join('services', 'classes.Service_ID', 'services.Service_ID')
                -> join('users', 'services.Tutor_ID', 'users.User_ID')
                -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
                -> where('classes.Class_ID', $id)
                -> select('classes.*', 'services.*', 'subjects.Subject_Name', 'users.First_Name',
                    'users.Last_Name', 'users.Date_of_Birth', 'users.Town', 'users.Country', 'users.Gender')
                -> first();
        else
            $class = DB::table('classes')
                -> join('services', 'classes.Service_ID', 'services.Service_ID')
                -> join('users', 'classes.Student_ID', 'users.User_ID')
                -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
                -> where('classes.Class_ID', $id)
                -> select('classes.*', 'services.*', 'subjects.Subject_Name', 'users.First_Name',
                    'users.Last_Name', 'users.Date_of_Birth', 'users.Town', 'users.Country', 'users.Gender')
                -> first();
        return response()->json($class);
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
     * @param string $status
     * @param int $id
     * @return void
     */
    public function updateStatus($status, $id)
    {
        DB::table('classes')
            -> where('classes.Class_ID', $id)
            -> update(['classes.Status' => $status]);
    }

    /**
     * Update student status.
     *
     * @param $status
     * @param $id
     * @return void
     */

    public function updateStudentStatus($status, $id)
    {
        DB::table('classes')
            -> where('classes.Class_ID', $id)
            -> update(['classes.Stu_Status' => $status]);
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
