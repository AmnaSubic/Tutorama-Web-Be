<?php

namespace App\Http\Controllers;

use App\Reviews;
use App\Http\Resources\Reviews as ReviewsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    /**
     * Display services for selected tutor.
     *
     * @param int $id
     * @return Collection
     */

    public function userReviews($id) {
        $isTutor = DB::table('users')
            -> where('User_ID', $id)
            -> value('Is_Tutor');
        if ($isTutor == 0)
            return DB::table('reviews')
                -> join('users', 'reviews.Tutor_ID', '=', 'users.User_ID')
                -> where('reviews.Student_ID', $id)
                -> where('reviews.Is_Tutor', 1)
                -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
                -> get();
        else
            return DB::table('reviews')
                -> join('users', 'reviews.Student_ID', '=', 'users.User_ID')
                -> where('reviews.Tutor_ID', $id)
                -> where('reviews.Is_Tutor', 0)
                -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
                -> get();
    }

    /**
     * Display reviews for the authorized user.
     *
     * @return Collection
     */
    public function authReviews() {
        $isTutor = DB::table('users')
            -> where('User_ID', auth()->user()->getAuthIdentifier())
            -> value('Is_Tutor');
        if ($isTutor == 0)
            return DB::table('reviews')
                -> join('users', 'reviews.Tutor_ID', 'users.User_ID')
                -> where('reviews.Student_ID', '=', auth()->user()->getAuthIdentifier())
                -> where('reviews.Is_Tutor', 1)
                -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
                -> get();
        else return DB::table('reviews')
            -> join('users', 'reviews.Student_ID', 'users.User_ID')
            -> where('reviews.Tutor_ID', '=', auth()->user()->getAuthIdentifier())
            -> where('reviews.Is_Tutor', 0)
            -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
            -> get();
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
