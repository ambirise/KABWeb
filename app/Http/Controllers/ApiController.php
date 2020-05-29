<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Controllers\Controller;
use App\Preferences;
use App\Student;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        // if($get_level_data_array==1){

        // }

        return $implode_levelid;

        // $implode_facultyid = implode(" ", $pluck_facultyid);

        if ($implode_yearorsemester !== "") {

        }
    }

    public function getsubjectApi($id)
    {
        $get_subject_data_array = DB::table('subjects')->where('semester_id', $id)->get();
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
        $student = Student::where("email", $request->email)->first();

        if ($student) {
            if (Hash::check($request->password, $student->password)) {
                $passwordcheck = $student;

            } else {
                json_encode('Invalid Username or Password Please Try Again');
            }
        }

        // if($student){
        //     if(Hash::check($request->password, $student->password)){
        //          return $student;
        //     }
        //     else
        //     {
        //         return response()->json(['message' => 'Sorry invalid email or password']);
        //     }
        // }
        // else
        //     {
        //         return response()->json(['message' => 'Sorry invalid email or password']);
        //     }

        if (isset($passwordcheck)) {

            $SuccessLoginMsg = 'Data Matched';

            // Converting the message into JSON format.
            $SuccessLoginJson = json_encode($SuccessLoginMsg);

            // Echo the message.
            echo $SuccessLoginJson;
        } else {

            // If the record inserted successfully then show the message.
            $InvalidMSG = 'Invalid Username or Password Please Try Again';

            // Converting the message into JSON format.
            $InvalidMSGJSon = json_encode($InvalidMSG);

            // Echo the message.
            echo $InvalidMSGJSon;

        }
    }

    public function addfavouritesAPI(Request $request, $id)
    {
        if (Content::where('content_id', $id)->first()) {
            $array = array();

            if (Student::where('id', $request->student_id)->first()) {
                $find_student_existence = Preferences::where('student_id', $request->student_id)->first();
                if ($find_student_existence) {
                    $json_favourite = Preferences::where('student_id', $request->student_id)->first();
                } else {
                    $preferences = new Preferences;
                    $preferences->student_id = $request->student_id;
                    $preferences->save();
                    $json_favourite = Preferences::where('student_id', $request->student_id)->first();
                }

                $json_favourite_content = $json_favourite->pluck('student_favourite')->first();
                $jsondecode_favourite_content = json_decode($json_favourite_content);

                // $favourite_content = json_encode($array);
                $get_content = Content::where('content_id', $id)->get()->count();

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
            echo json_encode("Sorry, Content does not exist");
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
        // $array = ["1", "2", "3"];
        // $favourite_content = json_encode($array);
        // if (Preferences::where('student_id', $request->student_id)->first()) {

        // $json_favourite = Preferences::where('student_id', $request->student_id)->first();
        // $json_favourite_content = $json_favourite->pluck('student_favourite')->first();
        // $jsondecode_favourite_content = json_decode($json_favourite_content);

        // if ($jsondecode_favourite_content == !null) {
        //     if (!in_array($id, $jsondecode_favourite_content)) {
        //         echo json_encode("Sorry, Student does not exist");
        //     }
        // }

        if (Preferences::where('student_id', $request->student_id)->first()) {
            $json_favourite_content = Preferences::where('student_id', $request->student_id)->pluck('student_favourite')->first();

            $jsondecode_favourite_content = json_decode($json_favourite_content);

            if (in_array($id, $jsondecode_favourite_content)) {
                $remove_content_array = array_diff($jsondecode_favourite_content, array($id));
                $final_collection = collect($remove_content_array)->values();
                $editfavourite = Preferences::where('student_id', $request->student_id)->first();
                $editfavourite->student_favourite = json_encode($final_collection);
                $editfavourite->save();
                echo json_encode("Content deleted successfully");
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
            $favourites_array[] = Content::where('content_id', $data)->first();
        }

        if ($favourites_array) {
            return array_values(array_filter($favourites_array));
        } else {
            echo json_encode("Sorry, Favourite does not exist");
        }
    }

    public function showhistoryAPI(Request $request)
    {
        $json_history_content = Preferences::where('student_id', $request->student_id)->pluck('student_history')->first();

        $jsondecode_history_content = json_decode($json_history_content);

        $history_array = null;
        foreach ($jsondecode_history_content as $data) {
            $history_array[] = Content::where('content_id', $data)->first();
        }

        if ($history_array) {
            return array_values(array_filter($history_array));
        } else {
            echo json_encode("Sorry, History does not exist");
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
}
