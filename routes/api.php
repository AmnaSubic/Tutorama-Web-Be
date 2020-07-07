<?php

use Illuminate\Support\Facades\Route;

Route::group ([
   'middleware' => 'api',

], function () {
    /*
    |-----------------------------|
    |       POST FUNCTIONS        |
    |-----------------------------|
    */
    /* LOGIN */
    Route::post('login', 'AuthController@login');

    /* REGISTER */
    Route::post('register', 'AuthController@register');

    /* LOGOUT */
    Route::post('logout', 'AuthController@logout');

    /* REFRESH */
    Route::post('refresh', 'AuthController@refresh');

    /* SEND PASSWORD RESET LINK */
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');

    /* PROCESS PASSWORD RESET */
    Route::post('resetPassword', 'ChangePasswordController@process');

    /* STORE NEW SERVICE (TUTOR) */
    Route::post('addService', 'ServicesController@store');

    /* STORE NEW AVAILABLE TIME (TUTOR) */
    Route::post('addAvailableTime', 'AvailableTimesController@store');

    /* STORE NEW CLASS (STUDENT) */
    Route::post('addClass', 'ClassesController@store');

    /* STORE NEW REVIEW */
    Route::post('addReview', 'ReviewsController@store');

    /*
    |-----------------------------|
    |       GET FUNCTIONS         |
    |-----------------------------|
    */
    /* GET AUTHORIZED USER */
    Route::get('me','AuthController@me');

    /* GET ALL SUBJECTS */
    Route::get('getSubjects','SubjectController@index');

    /* GET ALL SERVICES FOR AUTHORISED USER (TUTOR) */
    Route::get('getAuthUserServices','ServicesController@authUserServices');

    /* GET ALL AVAILABLE TIMES FOR AUTHORISED USER (TUTOR) */
    Route::get('getAuthUserAvailableTimes','AvailableTimesController@authUserAvailableTimes');

    /* GET ALL SERVICES IN THE DB */
    Route::get('getServices','ServicesController@index');

    /* GET INFORMATION ABOUT A SPECIFIED SERVICE */
    Route::get('getServices/{id}','ServicesController@show');

    /* GET INFORMATION ABOUT A SPECIFIED USER */
    Route::get('getUser/{id}','UserController@user');

    /* GET ALL SERVICES OF A SPECIFIED USER */
    Route::get('getUser/{id}/services','ServicesController@userServices');

    /* GET ALL AVAILABLE TIMES OF A SPECIFIED USER */
    Route::get('getUser/{id}/availableTimes','AvailableTimesController@userAvailableTimes');

    /* GET ALL CURRENT CLASSES FOR AUTHORISED USER */
    Route::get('getAuthClassesCurrent','ClassesController@authClassesCurrent');

    /* GET ALL CLASSES HISTORY FOR AUTHORISED USER */
    Route::get('getAuthClassesHistory', 'ClassesController@authClassesHistory');

    /* GET CLASS INFO */
    Route::get('getAuthClasses/{id}','ClassesController@show');

    /* GET REVIEWS FOR AUTHORISED USER */
    Route::get('getAuthReviews','ReviewsController@authReviews');

    /* GET REVIEWS FOR A SPECIFIED USER */
    Route::get('getUserReviews/{id}','ReviewsController@userReviews');

    /* SEARCH FOR SPECIFIC SERVICE */
    Route::get('search/{subject}', 'ServicesController@search');



    /*
   |-----------------------------|
   |       PUT FUNCTIONS         |
   |-----------------------------|
   */
    /* UPDATE CLASS STATUS */
    Route::put('updateClassStatus/{status}/{id}', 'ClassesController@updateStatus');

    /* UPDATE STUDENT CLASS STATUS */
    Route::put('updateStudentClassStatus/{status}/{id}', 'ClassesController@updateStudentStatus');

});
