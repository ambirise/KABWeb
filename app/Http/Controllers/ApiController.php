<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelsResource;
use App\Level;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public $successStatus = 200;
    public function accessToken(Request $request)
    {
        $validate = $this->validations($request, "login");

        if ($validate["error"]) {

            return $this->prepareResult(false, [], $validate['errors'], "Error while validating user");

        }

        $user = User::where("email", $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                return $this->prepareResult(true, ["accessToken" => $user->createToken('Todo App')->accessToken], [], "User Verified");

            } else {

                return $this->prepareResult(false, [], ["password" => "Wrong passowrd"], "Password not matched");

            }

        } else {

            return $this->prepareResult(false, [], ["email" => "Unable to find user"], "User not found");

        }

    }

    // /**

    //  * Get a validator for an incoming Todo request.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @param  $type

    //  * @return \Illuminate\Contracts\Validation\Validator

    //  */

    public function validations($request, $type)
    {

        $errors = [];

        $error = false;

        if ($type == "login") {

            $validator = Validator::make($request->all(), [

                'email' => 'required|email|max:255',

                'password' => 'required',

            ]);

            if ($validator->fails()) {

                $error = true;

                $errors = $validator->errors();

            }

        } elseif ($type == "create todo") {

            $validator = Validator::make($request->all(), [

                'todo' => 'required',

                'description' => 'required',

                'category' => 'required',

            ]);

            if ($validator->fails()) {

                $error = true;

                $errors = $validator->errors();

            }

        } elseif ($type == "update todo") {

            $validator = Validator::make($request->all(), [

                'todo' => 'filled',

                'description' => 'filled',

                'category' => 'filled',

            ]);

            if ($validator->fails()) {

                $error = true;

                $errors = $validator->errors();

            }

        }

        return ["error" => $error, "errors" => $errors];

    }

    // /**

    //  * Display a listing of the resource.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @return \Illuminate\Http\Response

    //  */

    private function prepareResult($status, $data, $errors, $msg)
    {
        return response()->json(['status' => $status, 'data' => $data, 'message' => $msg, 'errors' => $errors]);
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            // $user = Auth::user();
            // $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => "Successful"], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|numeric|digits:10',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['name'] = $user->name;
        $success['phone'] = $user->phone;
        $success['email'] = $user->email;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function getMessage()
    {
        $get_content_data_array = DB::table('contents')->get();
        return response()->json($get_content_data_array);
    }
    // /**

    //  * Display a listing of the resource.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @return \Illuminate\Http\Response

    //  */

    // public function index(Request $request)

    // {

    //     return $this->prepareResult(true, $request->user()->todo()->get(), [],"All user todos");

    // }

    // /**

    //  * Display the specified resource.

    //  *

    //  * @param  \App\Todo  $todo

    //  * @return \Illuminate\Http\Response

    //  */

    // public function show(Request $request,Todo $todo)

    // {

    //     if($todo->user_id == $request->user()->id){

    //         return $this->prepareResult(true, $todo, [],"All results fetched");

    //     }else{

    //         return $this->prepareResult(false, [], "unauthorized","You are not authenticated to view this todo");

    //     }

    // }

    // /**

    //  * Store a newly created resource in storage.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @return \Illuminate\Http\Response

    //  */

    // public function store(Request $request)

    // {

    //     $error = $this->validations($request,"create todo");

    //     if ($error['error']) {

    //         return $this->prepareResult(false, [], $error['errors'],"Error in creating todo");

    //     } else {

    //         $todo = $request->user()->todo()->Create($request->all());

    //         return $this->prepareResult(true, $todo, $error['errors'],"Todo created");

    //     }

    // }

    // /**

    //  * Update the specified resource in storage.

    //  *

    //  * @param  \Illuminate\Http\Request  $request

    //  * @param  \App\Todo  $todo

    //  * @return \Illuminate\Http\Response

    //  */

    // public function update(Request $request, Todo $todo)

    // {

    //     if($todo->user_id == $request->user()->id){

    //        $error = $this->validations($request,"update todo");

    //         if ($error['error']) {

    //             return $this->prepareResult(false, [], $error['errors'],"error in updating data");

    //         } else {

    //             $todo = $todo->fill($request->all())->save();

    //             return $this->prepareResult(true, $todo, $error['errors'],"updating data");

    //         }

    //     }else{

    //         return $this->prepareResult(false, [], "unauthorized","You are not authenticated to edit this todo");

    //     }

    // }

    // /**

    //  * Remove the specified resource from storage.

    //  *

    //  * @param  \App\Todo  $todo

    //  * @return \Illuminate\Http\Response

    //  */

    // public function destroy(Todo $todo)

    // {

    //     if($todo->user_id == $request->user()->id){

    //         if ($todo->delete()) {

    //             return $this->prepareResult(true, [], [],"Todo deleted");

    //         }

    //     }else{

    //         return $this->prepareResult(false, [], "unauthorized","You are not authenticated to delete this todo");
    //     }
    // }

    public function getTestApi()
    {
        $get_content_data_array = DB::table('contents')->get();
        return $get_content_data_array;
    }

    public function getlevelApi(): LevelsResource
    {
        $get_content_data_array = DB::table('levels')->get();
        return new LevelsResource($get_content_data_array, 200);
    }

    public function getfacultyApi($id)
    {
        $get_faculty_data_array = DB::table('faculties')->where('level_id', $id)->get();
        return $get_faculty_data_array;
    }

    public function getsemesterApi($id)
    {
        $get_semester_data_array = DB::table('semesters')->where('faculty_id', $id)->get();
        return $get_semester_data_array;
    }

    public function getsubjectApi($id)
    {
        $get_subject_data_array = DB::table('subjects')->where('faculty_id', $id)->get();
        return $get_subject_data_array;
    }

    public function getchapterApi($id)
    {
        $get_chapter_data_array = DB::table('chapters')->where('subject_id', $id)->get();
        return $get_chapter_data_array;
    }

    public function getcontentApi($id)
    {
        $get_content_data_array = DB::table('contents')->where('chapter_id', $id)->get();
        return $get_content_data_array;
    }

    public function search_faculties($query)
    {
        if ($query != '') {
            $get_faculty_data = DB::table('faculties')->where('faculty_title', 'like', '%' . $query . '%')->get();
        } else {
            $get_faculty_data = DB::table('faculties')
                ->get();
        }
        return $get_faculty_data;
    }

    public function search_subjects($query)
    {
        if ($query != '') {
            $get_subject_data = DB::table('subjects')->where('subject_title', 'like', '%' . $query . '%')->get();
        } else {
            $get_subject_data = DB::table('subjects')
                ->get();
        }
        return $get_subject_data;
    }

    public function search_chapters($query)
    {
        if ($query != '') {
            $get_chapter_data = DB::table('chapters')->where('chapter_title', 'like', '%' . $query . '%')->get();
        } else {
            $get_chapter_data = DB::table('chapters')
                ->get();
        }
        return $get_chapter_data;
    }

    public function search_contents($query)
    {
        if ($query != '') {
            $get_content_data = DB::table('contents')->where('content_type', 'like', '%' . $query . '%')->get();
        } else {
            $get_content_data = DB::table('contents')
                ->get();
        }
        return $get_content_data;
    }
}
