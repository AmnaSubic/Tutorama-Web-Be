<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() {
        return UserResource::collection(User::all());
    }

    /**
     * Get value of Is_Tutor for authorised user.
     *
     * @return Integer
     */
    public function getIsTutor() {
        return DB::table('users')
            -> where('User_ID', auth()->user()->getAuthIdentifier())
            -> value('Is_Tutor');
    }

    /**
     * Show profile by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function user($id) {
        $user = DB::table('users')
            ->where('User_ID', $id)
            ->first();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request) {
        $user = User::create($request->all());
        return new UserResource($user);
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
