<?php
use Illuminate\Support\Facades\Route;
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::any('{slug}', function() {
    return view('welcome');
})->where("slug", ".*");

Route::get('/home', 'HomeController@index')->name('home');
