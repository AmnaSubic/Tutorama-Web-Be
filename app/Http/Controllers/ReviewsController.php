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
                -> orderByDesc('reviews.Date')
                -> get();
        else
            return DB::table('reviews')
                -> join('users', 'reviews.Student_ID', '=', 'users.User_ID')
                -> where('reviews.Tutor_ID', $id)
                -> where('reviews.Is_Tutor', 0)
                -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
                -> orderByDesc('reviews.Date')
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
                -> orderByDesc('reviews.Date')
                -> get();
        else return DB::table('reviews')
            -> join('users', 'reviews.Student_ID', 'users.User_ID')
            -> where('reviews.Tutor_ID', '=', auth()->user()->getAuthIdentifier())
            -> where('reviews.Is_Tutor', 0)
            -> select('reviews.*', 'users.First_Name', 'users.Last_Name')
            -> orderByDesc('reviews.Date')
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
}
