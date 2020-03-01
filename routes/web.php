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

Route::prefix('student')->group(function(){
Route::get('/','AdminController@index')->name('admin.dashboard');
Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
});

Route::get('/faculties/{Level}', ['uses'=>'FacultiesController@index','as'=>'getfacultiesIndex']);
Route::post('faculties',['uses'=>'FacultiesController@store','as'=>'facultiesStore']);

// Route::get('/semesters/{Faculty}', ['uses'=>'SemestersController@index','as'=>'getsemestersIndex']);
Route::get('/subjects/{Semester}', ['uses'=>'SubjectsController@index','as'=>'getsubjectsIndex']);
Route::get('/chapters/{Subject}', ['uses'=>'ChaptersController@index','as'=>'getchaptersIndex']);
Route::get('/contents/{Chapter}', ['uses'=>'ContentsController@index','as'=>'getcontentsIndex']);

Route::get('/getcontent/{Content}', ['uses'=>'ShowcontentController@index','as'=>'getcontentShow']);

// Route::post('semesters/{Faculty}',['uses'=>'SemestersController@store','as'=>'semestersStore']);
Route::post('subjects/{Semester}',['uses'=>'SubjectsController@store','as'=>'subjectsStore']);
Route::post('chapters/{Subject}', ['uses'=>'ChaptersController@store','as'=>'chaptersStore']);
Route::post('contents/{Chapter}', ['uses'=>'ContentsController@store','as'=>'contentsStore']);

// For updates
Route::post('faculties{Faculty}/edit',['uses'=>'FacultiesController@update','as'=>'facultiesUpdate']);
Route::post('subjects{Subject}/edit',['uses'=>'SubjectsController@update','as'=>'subjectsUpdate']);
Route::post('chapters{Chapter}/edit',['uses'=>'ChaptersController@update','as'=>'chaptersUpdate']);

Route::get('delfacultiesdetails/{Faculty}/delete',['uses'=>'FacultiesController@delfacultiesDetails','as'=>'delfacultiesDetails']);
Route::get('delsubjectsdetails/{Subject}/delete',['uses'=>'SubjectsController@delsubjectsDetails','as'=>'delsubjectsDetails']);
Route::get('delchaptersdetails/{Chapter}/delete',['uses'=>'ChaptersController@delchaptersDetails','as'=>'delchaptersDetails']);
Route::get('delcontentsdetails/{Content}/delete',['uses'=>'ContentsController@delcontentsDetails','as'=>'delcontentsDetails']);

Route::any('/searchfaculties/{Level}',['uses'=>'FacultiesController@getfacultiesSearch','as'=>'getfacultiesSearch']);
Route::any('/searchsubjects/{Faculty}',['uses'=>'SubjectsController@getsubjectsSearch','as'=>'getsubjectsSearch']);
Route::any('/searchchapters/{Subjects}',['uses'=>'ChaptersController@getchaptersSearch','as'=>'getchaptersSearch']);
Route::any('/searchcontents/{Chapters}',['uses'=>'ContentsController@getcontentsSearch','as'=>'getcontentsSearch']);
Route::any('/searchall',['uses'=>'HomeController@getallSearch','as'=>'getallSearch']);

Route::any('/searchlevels',['uses'=>'LevelsController@getlevelsSearch','as'=>'getlevelsSearch']);
Route::get('/live_search/faculties', 'FacultiesController@action')->name('live_search.action');

Route::get('editfaculties/{Faculties}/edit',['uses'=>'FacultiesController@editfacultiesDetails','as'=>'editfacultiesDetails']);
Route::get('editsubjects/{Subject}/edit',['uses'=>'SubjectsController@editsubjectsDetails','as'=>'editsubjectsDetails']);
Route::get('editchapters/{Chapter}/edit',['uses'=>'ChaptersController@editchaptersDetails','as'=>'editchaptersDetails']);

Route::resource('/levels','LevelsController');
// Route::resource('/semesters','SemestersController');
// Route::resource('/subjects','SubjectsController');