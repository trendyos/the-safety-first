<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("vendor-list",'CommanController@getVendor');
Route::post("register",'CommanController@RegisterUser');
Route::post("login",'CommanController@login');
Route::post("logout",'CommanController@logout');

Route::post("send-otp",'CommanController@SendOtpToEmail');
Route::post("reset-password",'CommanController@ResetPassword');
Route::post("change-password",'CommanController@UpdatePassword');
Route::get("courses-list",'CommanController@getAllCourses');
Route::get("course-details/{id}",'CommanController@getCourseDetails');
Route::post("update-profile/{id}",'CommanController@UpdateUserProfile');

Route::get('learning-module-list','LearningModuleController@getAllLearningModule');
Route::post('add-new-learning-module','LearningModuleController@add_New_Learning_Module');





