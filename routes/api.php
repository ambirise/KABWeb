<?php
use Illuminate\Http\Request;
use App\Content;


/* 
|-----------------------------------------------------------------------
| API Routes
|-----------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login','ApiController@accessToken');
Route::post('/studentlogin','ApiController@getstudentLogin');

Route::post('/login/student','ApiController@accessStudentToken');

Route::group([
    'middleware' => 'auth:admin api'
  ], function() {
    Route::get('/content','ApiController@getMessage');
  });

  Route::group([
    'middleware' => 'auth:student api'
  ], function() {
    Route::get('/content/Student','ApiController@getMessageStudent');
  });

// Route::post('/login','ApiController@login');
// Route::post('reg', 'ApiController@register');

Route::get('/', 'ApiController@guardnameApi');

Route::get('/login', 'ApiController@getloginApi');
Route::get('/level', 'ApiController@getlevelApi');
Route::get('faculties/{id}', 'ApiController@getfacultyApi');
Route::get('semesters/{id}', 'ApiController@getsemesterApi');
Route::post('subjects', 'ApiController@getsubjectApi');

Route::post('subjectstest', 'ApiController@getsubjecttestApi');
// Route::get('chapters/{id}', 'ApiController@getchapterApi');
Route::post('contents/{id}', 'ApiController@getcontentApi');

Route::get('search_faculties/{query}', 'ApiController@search_faculties');
Route::get('search_subjects/{query}', 'ApiController@search_subjects');
Route::get('search_chapters/{query}', 'ApiController@search_chapters');
Route::get('search_contents/{query}', 'ApiController@search_contents');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testingapi', 'ApiController@getTestApi');

Route::get('/search_faculties_search/{query}', 'ApiController@getallSearch');

Route::get('/contents', ['uses'=>'ApiController@getcontentsAPI','as'=>'getcontentsAPI']);

//  Route for favourites
Route::post('/addfavourites/{id}', ['uses'=>'ApiController@addfavouritesAPI','as'=>'addfavouritesAPI']);
Route::post('/delfavourites/{id}', ['uses'=>'ApiController@delfavouritesAPI','as'=>'delfavouritesAPI']);

Route::post('/showfavourites', ['uses'=>'ApiController@showfavouritesAPI','as'=>'showfavouritesAPI']);

//  Route for history
Route::post('/addhistory/{id}', ['uses'=>'ApiController@addhistoryAPI','as'=>'addhistoryAPI']);
Route::post('/delhistory/{id}', ['uses'=>'ApiController@delhistoryAPI','as'=>'delhistoryAPI']);

Route::post('/showhistory', ['uses'=>'ApiController@showhistoryAPI','as'=>'showhistoryAPI']);

Route::get('/filterbyname/{name}', ['uses'=>'ApiController@filterbynameAPI','as'=>'filterbynameAPI']);
Route::get('/filterbygender/{gender}', ['uses'=>'ApiController@filterbygenderAPI','as'=>'filterbygenderAPI']);
Route::get('/filterbyage/{age}', ['uses'=>'ApiController@filterbyageAPI','as'=>'filterbyageAPI']);
Route::get('/filterbytype/{type}', ['uses'=>'ApiController@filterbytypeAPI','as'=>'filterbytypeAPI']);

Route::get('get_all/{query}', 'ApiController@get_all');

Route::post('/changepassword/{current_password}', 'ApiController@changepasswordAPI');
Route::post('/forgotpassword', 'ApiController@forgotpasswordAPI');
Route::post('/resetpassword', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('/isfavourite/{content_id}', 'ApiController@isfavouriteAPI');
Route::get('/getcontent/{content_id}/{student_id}', ['uses'=>'ApiController@getcontentShow','as'=>'getcontentShow']);

Route::post('/register', 'ApiController@studentRegistration');
