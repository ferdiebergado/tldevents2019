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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified', 'auth', 'active']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('programs', 'ProgramController');
    Route::resource('events', 'EventController');
    Route::resource('participants', 'ParticipantController');
});
