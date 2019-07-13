<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-track', 'TrackingController@show_track')->name('get_track');
Route::post('/get-track-via-number', 'TrackingController@detectCarrier')->name('detect-carrier');
Route::resource('/carriers', 'TrackingController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
