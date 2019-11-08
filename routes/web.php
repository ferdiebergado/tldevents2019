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
    Route::get('/participants/search', 'ParticipantController@search')->name('participants.search');
    Route::get('/participants/addtoevent', 'ParticipantController@createAndAddToEvent')->name('participants.create_and_add_to_event');
    Route::get('/participants/{participant}/addtoevent', 'ParticipantController@showAddToEventForm')->name('participants.show_add_to_event_form');
    Route::post('/participants/{participant}/addtoevent', 'ParticipantController@addToEvent')->name('participants.add_to_event');
    Route::resource('participants', 'ParticipantController');
});
