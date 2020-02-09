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


// Route::group(['middleware' => ['web','auth:api']], function()

// {

//    Route::post('/todo/','ApiController@store');

//    Route::get('/todo/','ApiController@index');

//    Route::get('/todo/{todo}','ApiController@show');

//    Route::put('/todo/{todo}','ApiController@update');

//    Route::delete('/todo/{todo}','ApiController@destroy');

// });





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/testingapi', 'ApiController@getTestApi');
Route::get('/contents', ['uses'=>'APIController@getcontentsAPI','as'=>'getcontentsAPI']);
