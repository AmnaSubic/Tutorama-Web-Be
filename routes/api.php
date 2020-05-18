<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
se|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group ([
   'middleware' => 'api',

], function () {
    /**
     * Post functions
     */
    //login
        Route::post('login', 'AuthController@login');
    //register
        Route::post('register', 'AuthController@register');
    //logout
        Route::post('logout', 'AuthController@logout');
    //refresh
        Route::post('refresh', 'AuthController@refresh');
    //send email for password reset
        Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    //process password request
        Route::post('resetPassword', 'ChangePasswordController@process');
    //store new tutor service
        Route::post('addService', 'ServicesController@store');
    //store new available time for currently authorised user
        Route::post('addAvailableTime', 'AvailableTimesController@store');
    //store new class
        Route::post('addClass', 'ClassesController@store');

    /**
     * Get functions
     */
    //authorised user
        Route::get('me', 'AuthController@me');
    //get all subjects
        Route::get('getSubjects', 'SubjectController@index');
    //get user services for currently authorised user
        Route::get('getAuthUserServices', 'ServicesController@authUserServices');
    //get available times for currently authorised user
        Route::get('getAuthUserAvailableTimes', 'AvailableTimesController@authUserAvailableTimes');
    //get all services from all users
        Route::get('getServices', 'ServicesController@index');
    //get information for a specific service
        Route::get('getServices/{id}', 'ServicesController@show');
    //get data for a specific user
        Route::get('getUser/{id}', 'UserController@user');
    //get all services of a specific user
        Route::get('getUser/{id}/services','ServicesController@userServices');
    //get all available times of a specific user
        Route::get('getUser/{id}/availableTimes','AvailableTimesController@userAvailableTimes');
    //get classes for authorized student
        Route::get('getAuthStudentClasses','ClassesController@authStudentClasses');
    //get classes for authorized tutor
        Route::get('getAuthTutorClasses', 'ClassesController@authTutorClasses');

});
