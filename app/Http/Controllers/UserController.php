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
}
