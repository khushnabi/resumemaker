<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/resume/create', 'resumeController@index');
Route::get('/resume/get', 'resumeController@getData');
Route::get('/resume/{id}','resumeController@show');
Route::post('/resume/{id}/edit', 'resumeController@editResume');
Route::post('/resume/{id}/delete', 'resumeController@deleteResume');
Route::post('/resume/upload', 'resumeController@upload');
Route::post('/resume/profile_img', 'resumeController@deleteImg');

Route::post('/resume/{resume}/experiance/create', 'experianceController@store');

Route::post('/resume/{resume}/education/create', 'educationController@store');

Route::post('/resume/{resume}/skill/create', 'skillController@store');

Route::post('/resume/{resume}/summary/create', 'summaryController@store');


Route::get('/', function () {
    // return response()->json([
    //     'msg' => "we should returen only json"
    // ]);

    return view('welcome');
});
// Route:get('/resume',"resumeController@index")->middleware("auth")


Route::any('{slug}', function() {
    return view('welcome');
});