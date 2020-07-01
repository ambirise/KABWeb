<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        //    if(Auth::guard('student')) {
        //         return "Hello Student";
        //     }

        // foreach(array_keys(config('auth.guards')) as $guard){
        //     if(auth()->guard($guard)) return $guard;
        // }

        $get_level_data = DB::table('levels')->get();
        return view('levels')->with('get_level_data', $get_level_data);
    }

    public function getallSearch(Request $request)
    {
        $query = $request->input('q');

        if ($query != '') {
            $data = DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->join('faculties', 'faculties.faculty_id', '=', 'subjects.faculty_id')->where('subjects.subject_title', 'LIKE', '%' . $query . '%')->get();

            if (count($data) < 1) {
                $data = DB::table('faculties')->join('levels', 'levels.level_id', '=', 'faculties.level_id')->where('faculties.faculty_title', 'LIKE', '%' . $query . '%')->get();
            } elseif (count($data) >= 1) {
                $datamergeone = DB::table('faculties')->join('levels', 'levels.level_id', '=', 'faculties.level_id')->where('faculties.faculty_title', 'LIKE', '%' . $query . '%')->get();
                $datamergetwo = DB::table('subjects')->join('levels', 'levels.level_id', '=', 'subjects.level_id')->join('faculties', 'faculties.faculty_id', '=', 'subjects.faculty_id')->where('subjects.subject_title', 'LIKE', '%' . $query . '%')->get();
                $data = $datamergeone->merge($datamergetwo);
            }

            // $data = DB::table('faculties')->join('subjects', 'subjects.faculty_id', '=', 'faculties.faculty_id')
            //     ->where('subjects.subject_title', 'LIKE', '%' . $query . '%')->orWhere('faculties.faculty_title', 'LIKE', '%' . $query . '%')
            //     ->select('faculties.faculty_id', 'faculties.faculty_title', 'subjects.subject_id', 'subjects.subject_title')
            //     ->get();

            //     foreach ($arraysearchresult as $objectone) {
            //         if (!empty($objectone->faculty_title) && empty($objectone->subject_title)) {
            //             $format_array_search_result1[] = array("faculty" => array('title' => $objectone->faculty_title, 'id' => $objectone->faculty_id));
            //         }

            //         if (!empty($objectone->subject_title) && !empty($objectone->subject_title)) {
            //             $format_array_search_result2[] = array("subject" => ['title' => $objectone->subject_title, 'id' => $objectone->subject_id], "faculty" => ['title' => $objectone->faculty_title, 'id' => $objectone->faculty_id], "semester" => ["semester" => $objectone->semester_title, "id" => $objectone->semester_id]);
            //         }
            //     }

        } else {
            $data = array();
        }

        return view('index')->with('data', $data);
    }
}
