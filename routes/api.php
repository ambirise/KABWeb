<?php

use Illuminate\Http\Request;
use App\Content;

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

Route::post('/login','ApiController@accessToken');


Route::group([
    'middleware' => 'auth:api'
  ], function() {
    Route::get('/content','ApiController@getMessage');
  });


// Route::post('/login','ApiController@login');
// Route::post('reg', 'ApiController@register');

Route::get('/level', 'ApiController@getlevelApi');

Route::get('faculties/{id}', 'ApiController@getfacultyApi');
Route::get('semesters/{id}', 'ApiController@getsemesterApi');

Route::get('subjects/{id}', 'ApiController@getsubjectApi');
Route::get('chapters/{id}', 'ApiController@getchapterApi');
Route::get('contents/{id}', 'ApiController@getcontentApi');

Route::get('search_faculties/{query}', 'APIController@search_faculties');
Route::get('search_subjects/{query}', 'APIController@search_subjects');
Route::get('search_chapters/{query}', 'APIController@search_chapters');
Route::get('search_contents/{query}', 'APIController@search_contents');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testingapi', 'ApiController@getTestApi');
Route::get('/contents', ['uses'=>'APIController@getcontentsAPI','as'=>'getcontentsAPI']);