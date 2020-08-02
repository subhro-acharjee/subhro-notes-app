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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/verifymail/{tokken}','verifyMail@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/save','HomeController@saveNotes');
Route::delete('/delete/{id}','HomeController@delete');
Route::post('/public/{id}','HomeController@togglePublic');
Route::get('/watch/note/with/id/{id}','HomeController@watch')->middleware('ispublic');