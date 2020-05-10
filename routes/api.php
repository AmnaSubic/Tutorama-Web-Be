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

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    //Route::post('user', '');
});

Route::middleware('api:auth')->group(function() {
    Route::get('profile', function() {
        return auth()->user;
    });
    Route::resource('users', 'UserController');
    Route::resource('students', 'StudentController');
    Route::resource('tutors', 'TutorController');
    Route::resource('classes', 'ClassesController');
    Route::resource('services', 'ServicesController');
    Route::resource('reviews', 'ReviewsController');
    Route::resource('available_times','AvailableTimesController');
    Route::resource('subjects', 'SubjectController');

});
