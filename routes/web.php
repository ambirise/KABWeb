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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/faculties/{Level}', ['uses'=>'FacultiesController@index','as'=>'getfacultiesIndex']);
Route::post('faculties',['uses'=>'FacultiesController@store','as'=>'facultiesStore']);

Route::get('/semesters/{Faculty}', ['uses'=>'SemestersController@index','as'=>'getsemestersIndex']);
Route::get('/subjects/{Semester}', ['uses'=>'SubjectsController@index','as'=>'getsubjectsIndex']);

Route::post('semesters/{Faculty}',['uses'=>'SemestersController@store','as'=>'semestersStore']);


Route::any('/searchfaculties/{Level}',['uses'=>'FacultiesController@getfacultiesSearch','as'=>'getfacultiesSearch']);
Route::any('/searchlevels',['uses'=>'LevelsController@getlevelsSearch','as'=>'getlevelsSearch']);

Route::get('/live_search/faculties', 'FacultiesController@action')->name('live_search.action');


Route::get('editfaculties/{Faculties}/edit',['uses'=>'FacultiesController@editfacultiesDetails','as'=>'editfacultiesDetails']);

Route::resource('/levels','LevelsController');
// Route::resource('/semesters','SemestersController');
// Route::resource('/subjects','SubjectsController');


