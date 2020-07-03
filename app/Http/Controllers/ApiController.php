<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Controllers\Controller;
use App\Preferences;
use App\Student;
use App\Subject;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApiController extends Controller
{
    public $successStatus = 200;
    public $student;

    public function guardnameApi()
    {

    }

    public function accessToken(Request $request)
    {
        $validate = $this->validations($request, "login");

        if ($validate["error"]) {
            return $this->prepareResult(false, [], $validate['errors'], "Error while validating user");
        }

        $user = Student::where("email", $request->email)->first();

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

    public function accessStudentToken(Request $request)
    {
        $validate = $this->validations($request, "login");

        if ($validate["error"]) {
            return $this->prepareResult(false, [], $validate['errors'], "Error while validating user");
        }

        $user = Student::where("email", $request->email)->first();

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
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }

        }
    }

    public function getMessageStudent()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
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

    public function getloginApi()
    {
        $get_user_data_array = DB::table('students')->select('email', 'password')->get();
        return $get_user_data_array;
    }

    public function getTestApi()
    {
        $get_content_data_array = DB::table('contents')->get();
        return $get_content_data_array;
    }

    public function getlevelApi()
    {
        $get_content_data_array = DB::table('levels')->get();
        return $get_content_data_array;
    }

    public function getfacultyApi($id)
    {
        $get_faculty_data_array = DB::table('faculties')->join('levels', 'levels.level_id', '=', 'faculties.level_id')->where('faculties.level_id', '=', $id)->get();
        return $get_faculty_data_array;
    }

    public function getsemesterApi($id)
    {
        $get_semester_data_array = DB::table('semesters')->join('levels', 'levels.level_id', '=', 'semesters.level_id')->where('faculty_id', $id)->get();
        return $get_semester_data_array;
    }

    public function getsubjectApi(Request $request)
    {
        $faculty_id = $request->faculty_id;
        $semester_id = $request->semester_id;

        if ($request->faculty_id == null) {
            $get_subject_data_array = DB::table('subjects')->where('semester_id', $semester_id)->pluck('subject_id')->toArray();

            $json_all_favourite_ids = DB::table('preferences')->where('student_id', $request->student_id)->pluck('student_favourite')->first();

            // $json_all_content_ids = Content::all()->pluck('content_id')->toArray();

            // $favourites_array = array();
            $jsondecode_all_favourite_ids = json_decode($json_all_favourite_ids);

            $array_unique = array_diff($get_subject_data_array, $jsondecode_all_favourite_ids);

            $subject_values_array_isfavourite = array();
            $subject_values_array = array();

            foreach ($jsondecode_all_favourite_ids as $data) {
                if (in_array($data, $get_subject_data_array)) {
                    $subject_values_one = collect(DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->where('subject_id', $data)->first());
                    $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
                    if (count($pluck_content_collection) > 0) {
                        $subject_values_one->put('hasContent', true);
                    } else {
                        $subject_values_one->put('hasContent', false);
                    }
                    $subject_values_array_isfavourite[] = $subject_values_one->put('isFavourite', true);
                    $subject_values_array++;
                }
            }

            foreach ($array_unique as $data) {
                $subject_values_two = collect(DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->where('subject_id', $data)->first());
                $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
                if (count($pluck_content_collection) > 0) {
                    $subject_values_two->put('hasContent', true);
                } else {
                    $subject_values_two->put('hasContent', false);
                }

                $subject_values_array[] = $subject_values_two->put('isFavourite', false);
                $subject_values_array++;
            }

            return array_merge($subject_values_array_isfavourite, $subject_values_array);
        }

        if ($request->semester_id == null) {

            $get_subject_data_array = DB::table('subjects')->where('faculty_id', $faculty_id)->pluck('subject_id')->toArray();

            $json_all_favourite_ids = DB::table('preferences')->where('student_id', $request->student_id)->pluck('student_favourite')->first();

            // $json_all_content_ids = Content::all()->pluck('content_id')->toArray();

            // $favourites_array = array();
            $jsondecode_all_favourite_ids = json_decode($json_all_favourite_ids);

            $array_unique = array_diff($get_subject_data_array, $jsondecode_all_favourite_ids);

            $aubject_values_array_isfavourite = array();
            $subject_values_array = array();

            foreach ($jsondecode_all_favourite_ids as $data) {
                if (in_array($data, $get_subject_data_array)) {
                    $subject_values_one = collect(DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->where('subject_id', $data)->first());
                    $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
                    if (count($pluck_content_collection) > 0) {
                        $subject_values_one > put('hasContent', true);
                    } else {
                        $subject_values_one->put('hasContent', false);
                    }
                    $subject_values_array_isfavourite[] = $subject_values_one->put('isFavourite', true);

                    $subject_values_array++;
                } else {
                    $subject_values_array_isfavourite = [];
                }
            }

            foreach ($array_unique as $data) {
                $subject_values_two = collect(DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->where('subject_id', $data)->first());
                $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
                if (count($pluck_content_collection) > 0) {
                    $subject_values_two->put('hasContent', true);
                } else {
                    $subject_values_two->put('hasContent', false);
                }

                $subject_values_array[] = $subject_values_two->put('isFavourite', false);
                $subject_values_array++;
            }

            return array_merge($subject_values_array_isfavourite, $subject_values_array);
        }
        // $get_subject_data_array = DB::table('subjects')->where('faculty_id', $id)->get();

        // return $get_subject_data_array;
    }

    public function getsubjecttestApi(Request $request)
    {

        if ($request->faculty_id == null) {
            $get_semester_data = DB::table('subjects')->where('semester_id', $request->semester_id)->get();
            return $get_semester_data;
        }

        if ($request->semester_id == null) {
            $get_semester_data = DB::table('subjects')->where('faculty_id', $request->faculty_id)->get();
            return $get_semester_data;
        }
    }

    public function getcontentApi(Request $request, $id)
    {
        $student_id = $request->student_id;
        $array = array();
        $json_student = Student::where('id', $student_id)->first();

        if ($json_student) {
            $json_history_content = Preferences::where('student_id', $student_id)->pluck('student_history')->first();

            if ($json_history_content) {
                $jsondecode_history_content = json_decode($json_history_content);

                $get_subject = Subject::where('subject_id', $id)->get()->count();

                if ($jsondecode_history_content == !null) {
                    if (in_array($id, $jsondecode_history_content)) {

                        // delete and add content id in existing case
                        $remove_content_array = array_diff($jsondecode_history_content, array($id));

                        $final_collection = collect($remove_content_array)->values();

                        $edithistory = Preferences::where('student_id', $request->student_id)->first();

                        $edithistory->student_history = json_encode($final_collection);
                        $edithistory->save();

                        $final_collection[] = $id;

                        $final_collection_array_length = count($final_collection);

                        if ($final_collection_array_length > 20) {

                            $remove_content_array = array_slice($jsondecode_history_content, 1);
                            $final_collection = collect($remove_content_array)->values();
                        }

                        $edithistory = Preferences::where('student_id', $student_id)->first();
                        $edithistory->student_history = $final_collection;
                        $edithistory->save();
                    }
                }

                $jsondecode_history_content[] = $id;
                $history_content = json_encode($jsondecode_history_content);

                $jsondecode_history_content_length = count($jsondecode_history_content);

                if ($jsondecode_history_content_length > 20) {
                    $jsondecode_history_content = $jsondecode_history_content;

                    $remove_content_array = array_slice($jsondecode_history_content, 1);
                    $history_content = collect($remove_content_array)->values();
                }

                $edithistory = Preferences::where('student_id', $student_id)->first();

                $edithistory->student_history = $history_content;
                $edithistory->save();
            } else {
                $jsondecode_history_content[] = $id;

                $history_content = json_encode($jsondecode_history_content);

                if ($jsondecode_history_content_length > 20) {
                    $jsondecode_history_content = array_reverse($jsondecode_history_content);
                    $remove_content_array = array_diff($jsondecode_history_content, array($id));
                    $history_content = collect($remove_content_array)->values();
                }

                $edithistory = Preferences::where('student_id', $student_id)->first();
                if ($edithistory) {
                    $edithistory->student_history = $history_content;
                    $edithistory->save();
                } else {
                    $edithistory = new Preferences;
                    $edithistory->student_id = $student_id;
                    $edithistory->student_history = $history_content;
                    $edithistory->save();
                }
            }
        } else {
            echo json_encode("Sorry, Student does not exist");
        }

        $get_content_data_array = DB::table('contents')->where('subject_id', $id)->pluck('content_id')->toArray();

        $json_all_favourite_ids = DB::table('preferences')->where('student_id', $request->student_id)->pluck('student_favourite')->first();

        // $json_all_content_ids = Content::all()->pluck('content_id')->toArray();

        // $favourites_array = array();
        $jsondecode_all_favourite_ids = json_decode($json_all_favourite_ids);

        $array_unique = array_diff($get_content_data_array, $jsondecode_all_favourite_ids);

        $content_values_array_isfavourite = array();
        $content_values_array = array();

        foreach ($jsondecode_all_favourite_ids as $data) {
            if (in_array($data, $get_content_data_array)) {
                $content_values_one = collect(DB::table('contents')->where('content_id', $data)->first());
                $content_values_array_isfavourite[] = $content_values_one->put('isFavourite', true);

                $content_values_array++;
            }
        }

        foreach ($array_unique as $data) {
            $content_values_two = collect(DB::table('contents')->where('content_id', $data)->first());
            $content_values_array[] = $content_values_two->put('isFavourite', false);
            $content_values_array++;
        }

        return array_merge($content_values_array_isfavourite, $content_values_array);
    }

    // public function get_all($id)
    // {
    //     $get_all_data = DB::table('contents')->join('chapters', 'contents.faculty_id', '=', 'chapters.faculty_id')->where('contents.content_id', $id)->first();
    //     return $get_all_data;

    // }

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
            $get_chapter_data = DB::table('chapters')->get();
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

    public function getallSearch($query)
    {
        $Test = DB::table('subjects')->join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->get();

        if ($query != '') {
            if ($test) {

                $searchsubject = DB::table('faculties')->get();

                $searchsubjectbytitle = DB::table('faculties')->join('subjects', 'subjects.faculty_id', '=', 'faculties.faculty_id')
                    ->join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
                    ->where('subjects.subject_title', 'LIKE', '%' . $query . '%')->orwhere('faculties.faculty_title', 'LIKE', '%' . $query . '%')
                    ->select('faculties.faculty_id', 'faculties.faculty_title', 'subjects.subject_id', 'subjects.subject_title', 'semesters.semester_title', 'semesters.semester_id')
                    ->get();

                foreach ($searchsubjectbytitle as $objectone) {

                    $format_array_search_result1[] = array("faculty" => array('title' => $objectone->faculty_title, 'id' => $objectone->faculty_id));

                    $format_array_search_result2[] = array("subject" => ['title' => $objectone->subject_title, 'id' => $objectone->subject_id], "faculty" => ['title' => $objectone->faculty_title, 'id' => $objectone->faculty_id], "semester" => ["semester" => $objectone->semester_title, "id" => $objectone->semester_id]);
                }

            } else {
                $searchsubjectbytitle = DB::table('faculties')->join('subjects', 'subjects.faculty_id', '=', 'faculties.faculty_id')
                    ->where('subjects.subject_title', 'LIKE', '%' . $query . '%')->orwhere('faculties.faculty_title', 'LIKE', '%' . $query . '%')
                    ->select('faculties.faculty_id', 'faculties.faculty_title', 'subjects.subject_id', 'subjects.subject_title')
                    ->get();
            }

            // $searchfacultybytitle = DB::table('faculties')->select('faculty_title', 'faculty_id')->where('faculty_title', 'LIKE', '%' . $query . '%')->get();

            // $arraysearchresult = $searchfacultybytitle->merge($searchsubjectbytitle);

            $data = array("facultylist" => $format_array_search_result1, "subjectlist" => $format_array_search_result2);

        } else {
            $data = DB::table('faculties')->join('subjects', 'subjects.faculty_id', '=', 'faculties.faculty_id')
                ->join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->get();
        }

        return $data;
    }

    public function getStudentLogin(Request $request)
    {
        $student = Student::where("phone", $request->phone)->first();

        if ($student) {
            if (Hash::check($request->password, $student->password)) {
                $passwordcheck = $student;
            } else {
                return response()->json(['status' => 'false', 'message' => 'Invalid Login Details!! Please Try Again']);
            }
        }

        if (isset($passwordcheck)) {
            $SuccessData = Student::select('id as student_id', 'name', 'phone', 'level')->where("phone", $request->phone)->first();

            // Converting the message into JSON format.

            return response()->json(['status' => 'true', 'data' => $SuccessData]);
        } else {
            return response()->json(['status' => 'false', 'message' => 'Invalid Login Details!! Please Try Again']);
        }
    }

    public function addfavouritesAPI(Request $request, $id)
    {
        if (Subject::where('subject_id', $id)->first()) {
            $array = array();

            if (Student::where('id', $request->student_id)->first()) {
                $find_student_existence = Preferences::where('student_id', $request->student_id)->pluck('student_favourite')->first();

                if ($find_student_existence) {
                    $json_favourite = Preferences::where('student_id', $request->student_id)->get();

                } else {
                    $preferences = new Preferences;
                    $preferences->student_id = $request->student_id;
                    $preferences->save();
                    $json_favourite = Preferences::where('student_id', $request->student_id)->first();
                }

                $json_favourite_content = $find_student_existence;

                $jsondecode_favourite_content = json_decode($json_favourite_content);

                // $favourite_content = json_encode($array);
                $get_content = Subject::where('subject_id', $id)->get()->count();

                if ($jsondecode_favourite_content == !null) {
                    if (in_array($id, $jsondecode_favourite_content)) {
                        echo json_encode("Favourite already exists");
                        exit();
                    }
                }

                $jsondecode_favourite_content[] = $id;

                $favourite_content = json_encode($jsondecode_favourite_content);

                //for getting student level , faculty and semester
                // $get_student_level = DB::table('levels')->where('student_id', 1)->get();
                // return $get_student_level;

                $editfavourite = Preferences::where('student_id', $request->student_id)->first();

                $editfavourite->student_favourite = $favourite_content;
                $editfavourite->save();
                echo json_encode("Favourite added successfully");
            } else {
                echo json_encode("Sorry, Student does not exist");
            }
        } else {
            echo json_encode("Sorry, Subject does not exist");
        }
    }

    public function addhistoryAPI(Request $request, $id)
    {
        if (Content::where('content_id', $id)->first()) {
            $array = array();

            $json_student = Student::where('id', $request->student_id)->first();

            if ($json_student) {
                $json_history_content = Preferences::where('student_id', $request->student_id)->pluck('student_history')->first();

                if ($json_history_content) {
                    $jsondecode_history_content = json_decode($json_history_content);

                    // $favourite_content = json_encode($array);
                    $get_content = Content::where('content_id', $id)->get()->count();

                    if ($jsondecode_history_content == !null) {
                        if (in_array($id, $jsondecode_history_content)) {
                            echo json_encode("History already exists");
                            exit();
                        }
                    }

                    $jsondecode_history_content[] = $id;
                    $history_content = json_encode($jsondecode_history_content);

                    $edithistory = Preferences::where('student_id', $request->student_id)->first();

                    $edithistory->student_history = $history_content;
                    $edithistory->save();
                    echo json_encode("History added successfully");
                } else {
                    $jsondecode_history_content[] = $id;

                    $history_content = json_encode($jsondecode_history_content);

                    $edithistory = Preferences::where('student_id', $request->student_id)->first();
                    if ($edithistory) {
                        $edithistory->student_history = $history_content;
                        $edithistory->save();
                        echo json_encode("History added successfully");
                    } else {
                        $edithistory = new Preferences;
                        $edithistory->student_id = $request->student_id;
                        $edithistory->student_history = $history_content;
                        $edithistory->save();
                        echo json_encode("History added successfully");
                    }
                }
            } else {
                echo json_encode("Sorry, Student does not exist");
            }
        } else {
            echo json_encode("Sorry, Content does not exist");
        }
    }

    public function delfavouritesAPI(Request $request, $id)
    {
        if (Preferences::where('student_id', $request->student_id)->first()) {
            $json_favourite_content = Preferences::where('student_id', $request->student_id)->pluck('student_favourite')->first();

            $jsondecode_favourite_content = json_decode($json_favourite_content);

            if (in_array($id, $jsondecode_favourite_content)) {
                $remove_content_array = array_diff($jsondecode_favourite_content, array($id));
                $final_collection = collect($remove_content_array)->values();
                $editfavourite = Preferences::where('student_id', $request->student_id)->first();
                $editfavourite->student_favourite = json_encode($final_collection);
                $editfavourite->save();
                echo json_encode("Subject deleted successfully");
            } else {
                echo json_encode("Sorry, Favourite does not exist");
            }
        } else {
            echo json_encode("Sorry, Favourite does not exist");
        }
    }

    public function delhistoryAPI(Request $request, $id)
    {
        if (Preferences::where('student_id', $request->student_id)->first()) {

            $json_history_content = Preferences::where('student_id', $request->student_id)->pluck('student_history')->first();

            $jsondecode_history_content = json_decode($json_history_content);

            if (in_array($id, $jsondecode_history_content)) {
                $remove_content_array = array_diff($jsondecode_history_content, array($id));
                $final_collection = collect($remove_content_array)->values();

                $edithistory = Preferences::where('student_id', $request->student_id)->first();

                $edithistory->student_history = json_encode($final_collection);
                $edithistory->save();
                echo json_encode("Content deleted successfully");
            } else {
                echo json_encode("Sorry, History does not exist");
            }
        } else {
            echo json_encode("Sorry, History does not exist");
        }
    }

    public function showfavouritesAPI(Request $request)
    {
        $json_favourite_content = Preferences::where('student_id', $request->student_id)->pluck('student_favourite')->first();

        $jsondecode_favourite_content = json_decode($json_favourite_content);

        $favourites_array = null;

        foreach ($jsondecode_favourite_content as $data) {
            $array = collect(Subject::where('subject_id', $data)->first());

            if (count($array) == 0) {
                $array = Subject::where('subject_id', $data)->first();
            }

            $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
           
           
            if (count($pluck_content_collection) > 0 && count(collect(Subject::where('subject_id', $data)->first())) > 0) {
                $array->put('hasContent', true);
            }

            if (count($pluck_content_collection) == 0 && count(collect(Subject::where('subject_id', $data)->first())) > 0) {
                $array->put('hasContent', false);
            }

            $favourites_array[] = $array;
        }

        if ($favourites_array) {
            return array_values(array_filter(array_reverse($favourites_array)));
        } else {
            $empty_array = array();
            return $empty_array;
        }
    }

    public function showhistoryAPI(Request $request)
    {
        $json_history_content = Preferences::where('student_id', $request->student_id)->pluck('student_history')->first();

        $jsondecode_history_content = json_decode($json_history_content);

        $history_array = null;
        foreach ($jsondecode_history_content as $data) {
            $array = collect(Subject::where('subject_id', $data)->first());
            
            if (count($array) == 0) {
                $array = Subject::where('subject_id', $data)->first();
            }

            $pluck_content_collection = collect(DB::table('contents')->where('subject_id', $data)->get());
            if (count($pluck_content_collection) > 0 && count(collect(Subject::where('subject_id', $data)->first())) > 0) {
                $array->put('hasContent', true);
            }

            if (count($pluck_content_collection) == 0 && count(collect(Subject::where('subject_id', $data)->first())) > 0) {
                $array->put('hasContent', false);
            }

            $history_array[] = $array;
        }

        if ($history_array) {
            return array_values(array_filter(array_reverse($history_array)));
        } else {
            $empty_array = array();
            return $empty_array;
        }
    }

    public function filterbynameAPI($name)
    {
        //filter by name
        // $name = "";
        if ($name) {
            $sort_student_byname = Student::where('name', $name)->get();
            return $sort_student_byname;
        }
    }

    public function filterbygenderAPI($gender)
    {
        //filter by gender
        // $gender = "";
        if ($gender) {
            $sort_student_bygender = Student::where('gender', $gender)->get();
            return $sort_student_bygender;
        }
    }

    public function filterbyageAPI($age)
    {
        // filter by age
        // $age = "";
        if ($age) {
            $sort_student_byage = Student::where('age', $age)->get();
            return $sort_student_byage;
        }
    }

    public function filterbytypeAPI($type)
    {
        if ($type) {
            $sort_student_bytype = Student::where('type', $type)->get();
            return $sort_student_bytype;
        }
    }

    public function changepasswordAPI(Request $request, $current_password)
    {
        $hashed_password = Student::where('id', $request->student_id)->pluck('password')->first();

        if (Hash::check($current_password, $hashed_password)) {
            $students = student::find($request->student_id);
            $students->password = Hash::make($request->new_password);
            $students->save();
            echo json_encode("Password successfully changed");
        } else {
            echo json_encode("Sorry, Password does not match");
        }
    }

    public function sendResetLinkEmail(Request $request, $student_id, $email)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $email
        );

        return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($request, $response)
        : $this->sendResetLinkFailedResponse($request, $response);

    }

    public function getTest()
    {
        if (Content::where('content_id', $content_id)->first()) {
            $array = array();

            $json_student = Student::where('id', $student_id)->first();

            if ($json_student) {
                $json_history_content = Preferences::where('student_id', $student_id)->pluck('student_history')->first();

                if ($json_history_content) {
                    $jsondecode_history_content = json_decode($json_history_content);

                    $get_content = Content::where('content_id', $content_id)->get()->count();

                    if ($jsondecode_history_content == !null) {
                        if (in_array($content_id, $jsondecode_history_content)) {

                            // delete and add content id in existing case
                            $remove_content_array = array_diff($jsondecode_history_content, array($content_id));
                            $final_collection = collect($remove_content_array)->values();

                            $edithistory = Preferences::where('student_id', $request->student_id)->first();

                            $edithistory->student_history = json_encode($final_collection);
                            $edithistory->save();

                            $final_collection[] = $content_id;

                            $final_collection_array_length = count($final_collection);

                            if ($final_collection_array_length > 20) {

                                $remove_content_array = array_slice($jsondecode_history_content, 1);
                                $final_collection = collect($remove_content_array)->values();
                            }

                            $edithistory = Preferences::where('student_id', $student_id)->first();
                            $edithistory->student_history = $final_collection;
                            $edithistory->save();

                            // for playing audio

                            $get_id_content = DB::table('contents')->where('content_id', $content_id)->get();
                            $pluck_contenttitle_content = Arr::pluck($get_id_content, ['content_title']);
                            $implode_contenttitle_content = implode(" ", $pluck_contenttitle_content);

                            $path = public_path() . DIRECTORY_SEPARATOR . "audios" . DIRECTORY_SEPARATOR . $implode_contenttitle_content;
                            $response = new BinaryFileResponse($path);
                            BinaryFileResponse::trustXSendfileTypeHeader();
                            return $response;
                            exit();
                        }
                    }

                    $jsondecode_history_content[] = $content_id;
                    $history_content = json_encode($jsondecode_history_content);

                    $jsondecode_history_content_length = count($jsondecode_history_content);

                    if ($jsondecode_history_content_length > 20) {
                        $jsondecode_history_content = $jsondecode_history_content;

                        $remove_content_array = array_slice($jsondecode_history_content, 1);
                        $history_content = collect($remove_content_array)->values();
                    }

                    $edithistory = Preferences::where('student_id', $student_id)->first();

                    $edithistory->student_history = $history_content;
                    $edithistory->save();

                    // for playing audio

                    $get_id_content = DB::table('contents')->where('content_id', $content_id)->get();
                    $pluck_contenttitle_content = Arr::pluck($get_id_content, ['content_title']);
                    $implode_contenttitle_content = implode(" ", $pluck_contenttitle_content);

                    $path = public_path() . DIRECTORY_SEPARATOR . "audios" . DIRECTORY_SEPARATOR . $implode_contenttitle_content;
                    $response = new BinaryFileResponse($path);
                    BinaryFileResponse::trustXSendfileTypeHeader();
                    return $response;
                } else {
                    $jsondecode_history_content[] = $content_id;

                    $history_content = json_encode($jsondecode_history_content);

                    if ($jsondecode_history_content_length > 20) {
                        $jsondecode_history_content = array_reverse($jsondecode_history_content);
                        $remove_content_array = array_diff($jsondecode_history_content, array($content_id));
                        $history_content = collect($remove_content_array)->values();
                    }

                    $edithistory = Preferences::where('student_id', $student_id)->first();
                    if ($edithistory) {
                        $edithistory->student_history = $history_content;
                        $edithistory->save();
                    } else {
                        $edithistory = new Preferences;
                        $edithistory->student_id = $student_id;
                        $edithistory->student_history = $history_content;
                        $edithistory->save();
                    }

                }
            } else {
                echo json_encode("Sorry, Student does not exist");
            }
        } else {
            echo json_encode("Sorry, Content does not exist");
        }
    }

    public function getcontentShow(Request $request, $content_id, $student_id)
    {
        $get_id_content = DB::table('contents')->where('content_id', $content_id)->get();

        $pluck_contenttitle_content = Arr::pluck($get_id_content, ['content_title']);
        $implode_contenttitle_content = implode(" ", $pluck_contenttitle_content);

        $path = public_path() . DIRECTORY_SEPARATOR . "audios" . DIRECTORY_SEPARATOR . $implode_contenttitle_content;
        $response = new BinaryFileResponse($path);
        BinaryFileResponse::trustXSendfileTypeHeader();
        return $response;
    }

    public function studentRegistration(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $level = $request->level;
        $password = Hash::make($request->password);

        if (strlen($name) < 1) {
            return response()->json(['message' => 'Name is required']);
        }

        if (strlen($phone) !== 10) {
            return response()->json(['message' => 'Phone number invalid']);
        }

        if (strlen($request->password) < 1) {
            return response()->json(['message' => 'Password is required']);
        }

        $CheckSQL = DB::table('students')->where('phone', $phone)->get();

        if (!count($CheckSQL) == 0) {
            return response()->json(['status' => 'false', 'message' => 'Phone number already exists']);
        } else {
            $addStudent = new Student;
            $addStudent->name = $name;
            $addStudent->phone = $phone;
            $addStudent->level = $level;
            $addStudent->password = $password;
            $addStudent->save();

            //  for posting in the preference table
            $student_all_ids = DB::table('students')->pluck('id')->toArray();
            // return array_values($student_all_ids);

            $preference_student_id = DB::table('preferences')->pluck('student_id')->toArray();

            $merge_array = array_merge($student_all_ids, $preference_student_id);
            // return $merge_array;
            $array_unique = array_diff($student_all_ids, $preference_student_id);
            $data_array = array_values($array_unique);

            $data_entry_times = 0;

            foreach ($data_array as $data) {
                $save_studentid_preferences = new Preferences;
                $save_studentid_preferences->student_id = $data;
                $save_studentid_preferences->save();
                $data_entry_times++;
            }

            // finish posting preferences

            $SuccessData = Student::select('id as student_id', 'name', 'level', 'phone')->where("phone", $request->phone)->first();

            return response()->json(['status' => 'true', 'data' => $SuccessData]);
        }
    }
}
