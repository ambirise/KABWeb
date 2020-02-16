<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;

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
    public function index()
    {
        $get_data = Level::all()->map->only(['level_title']);
        $get_school=$get_data[0]['level_title'];  // get School String
        $get_bachelor=$get_data[1]['level_title'];  // get Bachelor String
        $get_10plus2=$get_data[2]['level_title'];  // get 10+2 String
        $get_loksewa=$get_data[3]['level_title'];  // get Loksewa String
        return view('index')->with('get_school',$get_school)->with('get_bachelor',$get_bachelor)
        ->with('get_10plus2',$get_10plus2)->with('get_loksewa',$get_loksewa);
    }

    public function getallSearch(Request $request)
    {
        $query = $request->input('q');
        if ($query != '') {
            $searchsubjectbytitle = DB::table('faculties')->join('subjects', 'subjects.f_id', '=', 'faculties.f_id')
                ->join('semesters', 'semesters.sem_id', '=', 'subjects.sem_id')
                ->where('subjects.subjecttitle', 'LIKE', '%' . $query . '%')->select('faculties.f_id', 'faculties.title', 'subjects.s_id', 'subjects.subjecttitle', 'semesters.semester', 'semesters.sem_id')
                ->get();
            
            return $searchsubjectbytitle;

            $searchfacultybytitle = DB::table('faculties')->select('title', 'f_id')->where('title', 'LIKE', '%' . $query . '%')->get();

            $arraysearchresult = $searchfacultybytitle->merge($searchsubjectbytitle);

            foreach ($arraysearchresult as $objectone) {
                if (!empty($objectone->title) && empty($objectone->subjecttitle)) {
                    $format_array_search_result1[] = array("faculty" => array('title' => $objectone->title, 'id' => $objectone->f_id));
                }
                if (!empty($objectone->subjecttitle) && !empty($objectone->subjecttitle)) {
                    $format_array_search_result2[] = array("subject" => ['title' => $objectone->subjecttitle, 'id' => $objectone->s_id], "faculty" => ['title' => $objectone->title, 'id' => $objectone->f_id], "semester" => ["semester" => $objectone->semester, "id" => $objectone->sem_id]);
                }
            }

            $data = array("facultylist" => $format_array_search_result1, "subjectlist" => $format_array_search_result2);

        } else {
            $data = DB::table('faculties')->join('subjects', 'subjects.f_id', '=', 'faculties.f_id')
                ->join('semesters', 'semesters.sem_id', '=', 'subjects.sem_id')->get();
            dd($data);
        }
        return view('levels')->with('get_level_data', $get_level_data);
    }
}
