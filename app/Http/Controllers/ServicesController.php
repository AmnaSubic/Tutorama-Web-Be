<?php

namespace App\Http\Controllers;

use App\Services;
use App\Http\Resources\Services as ServicesResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return DB::table('services')
            -> join('users', 'services.Tutor_ID', '=', 'users.User_ID')
            -> join('subjects', 'services.Subject_ID', '=', 'subjects.Subject_ID')
            -> select('services.*', 'users.Town', 'users.Country', 'subjects.Subject_Name')
            -> get();
    }

    /**
     * Display services for authorized user.
     *
     * @return Collection
     */

    public function authUserServices()
    {
        return DB::table('services')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> where('services.Tutor_ID', auth()->user()->getAuthIdentifier())
            -> select('services.*', 'subjects.Subject_Name')
            -> get();
    }

    /**
     * Display services for selected tutor.
     *
     * @param int $id
     * @return Collection
     */

    public function userServices($id) {
        return DB::table('services')
            -> join('subjects', 'services.Subject_ID', '=', 'subjects.Subject_ID')
            -> where('services.Tutor_ID', $id)
            -> select('services.*', 'subjects.Subject_Name')
            -> get();
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $service = DB::table('services')
            -> join('users', 'services.Tutor_ID', 'users.User_ID')
            -> join('subjects', 'services.Subject_ID', 'subjects.Subject_ID')
            -> where('services.Service_ID', $id)
            -> select('services.*', 'users.First_Name', 'users.Last_Name', 'users.Experience',
                'users.Description', 'users.Availability', 'users.Address', 'users.Town', 'users.Country',
                'subjects.Subject_Name')
            -> first();
        return response()->json($service);
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
     * Search for specific service
     * @param string $subject
     * @return Collection
     */
    public function search($subject) {

        if ($subject == 'undefined' || $subject == 'all')
            return DB::table('services')
                -> join('users', 'services.Tutor_ID', '=', 'users.User_ID')
                -> join('subjects', 'services.Subject_ID', '=', 'subjects.Subject_ID')
                -> select('services.*', 'users.Town', 'users.Country', 'subjects.Subject_Name')
                -> get();
        else return DB::table('services')
            -> join('users', 'services.Tutor_ID', '=', 'users.User_ID')
            -> join('subjects', 'services.Subject_ID', '=', 'subjects.Subject_ID')
            -> where('subjects.Subject_Name', 'LIKE', '%'.$subject.'%')
            -> select('services.*', 'users.Town', 'users.Country', 'subjects.Subject_Name')
            -> get();
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
