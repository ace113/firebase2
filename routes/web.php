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

Route::get('/firebase', 'FirebaseController@index');

Route::get('/subject','SubjectController@index')->name('subject');
Route::get('/subject/add', function(){
    return view('pages.form');
});
Route::post('/subject','SubjectController@addSubject')->name('subject_add');
Route::get('/class','ClassesController@index')->name('class');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
