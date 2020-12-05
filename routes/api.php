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
Route::resource('resumes', 'ResumeController');
Route::post('/resumes/upload', 'ResumeController@upload');
Route::post('/resumes/profile_img', 'ResumeController@deleteImg');
Route::resource('resumes.experiences', 'ExperienceController');
Route::resource('resumes.educations', 'EducationController');
Route::resource('resumes.skills', 'SkillController');
Route::resource('resumes.summaries', 'SummaryController');
Route::resource('/resumes.customs', 'CustomController');
