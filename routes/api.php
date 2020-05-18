<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group ([
   'middleware' => 'api',

], function () {
    /*
    |-----------------------------|
    |       POST FUNCTIONS        |
    |-----------------------------|
    */
    /*
     * LOGIN
     */
        Route::post('login', 'AuthController@login');
    /*
     * REGISTER
     */
        Route::post('register', 'AuthController@register');
    /*
     * LOGOUT
     */
        Route::post('logout', 'AuthController@logout');
    /*
     * REFRESH
     */
        Route::post('refresh', 'AuthController@refresh');
    /*
     * SEND PASSWORD RESET LINK
     */
        Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    /*
     * PROCESS PASSWORD RESET
     */
        Route::post('resetPassword', 'ChangePasswordController@process');
    /*
     * STORE NEW SERVICE (TUTOR)
     */
        Route::post('addService', 'ServicesController@store');
    /*
     * STORE NEW AVAILABLE TIME (TUTOR)
     */
        Route::post('addAvailableTime', 'AvailableTimesController@store');
    /*
     * STORE NEW CLASS (STUDENT)
     */
        Route::post('addClass', 'ClassesController@store');

    /*
    |-----------------------------|
    |       GET FUNCTIONS         |
    |-----------------------------|
    */
    /*
     * GET AUTHORIZED USER
     */
        Route::get('me', 'AuthController@me');
    /*
     * GET ALL SUBJECTS
     */
        Route::get('getSubjects', 'SubjectController@index');
    /*
     * GET ALL SERVICES FOR AUTHORISED USER (TUTOR)
     */
        Route::get('getAuthUserServices', 'ServicesController@authUserServices');
    /*
     * GET ALL AVAILABLE TIMES FOR AUTHORISED USER (TUTOR)
     */
        Route::get('getAuthUserAvailableTimes', 'AvailableTimesController@authUserAvailableTimes');
    /*
     * GET ALL SERVICES IN THE DB
     */
        Route::get('getServices', 'ServicesController@index');
    /*
     * GET INFORMATION ABOUT A SPECIFIED SERVICE
     */
        Route::get('getServices/{id}', 'ServicesController@show');
    /*
     * GET INFORMATION ABOUT A SPECIFIED USER
     */
        Route::get('getUser/{id}', 'UserController@user');
    /*
     * GET ALL SERVICES OF A SPECIFIED USER
     */
        Route::get('getUser/{id}/services','ServicesController@userServices');
    /*
     * GET ALL AVAILABLE TIMES OF A SPECIFIED USER
     */
        Route::get('getUser/{id}/availableTimes','AvailableTimesController@userAvailableTimes');
    /*
     * GET ALL CLASSES FOR AUTHORISED USER (STUDENT)
     */
        Route::get('getAuthStudentClasses','ClassesController@authStudentClasses');
    /*
     * GET ALL CLASSES FOR AUTHORISED USER (TUTOR)
     */
        Route::get('getAuthTutorClasses', 'ClassesController@authTutorClasses');
});
