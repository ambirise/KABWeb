<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Faculty;
use App\Level;
use App\Semester;
use App\Subject;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, $faculty_id)
    {
        if (Semester::where('faculty_id', $faculty_id)->first() == null) {
            $get_semester_data = Faculty::where('faculty_id', $faculty_id)->first();
        } else {
            $get_semester_data = Semester::where('faculty_id', $faculty_id)->first();
        }

        $get_faculty_data = Faculty::where('faculty_id', $faculty_id)->first();

        $get_faculty_data_level_title = Faculty::where('faculty_id', $faculty_id)->get();

        $get_semester_data_array = Semester::where('faculty_id', $faculty_id)->get();
        $pluck_semesterid_semester = Arr::pluck($get_semester_data_array, ['semester_id']);
        $semester_id = implode(" ", $pluck_semesterid_semester);

        $get_subject_data = DB::table('subjects')->where('faculty_id', $faculty_id)->get();
    
        $pluck_level_id = Arr::pluck($get_faculty_data_level_title, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        // for displaying in the subjects by number of semester or number of year
        $get_all_subjects_from_semester = DB::table('semesters')->join('subjects', 'semesters.semester_id', '=', 'subjects.semester_id')->where('semesters.numberofsemester','=',$get_semester_data->numberofsemester)->get();

        return view('subjects')->with('get_semester_data', $get_semester_data)
            ->with('get_subject_data', $get_subject_data)->with('get_faculty_data', $get_faculty_data)
            ->with('level_title', $level_title)->with('get_all_subjects_from_semester', $get_all_subjects_from_semester);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $faculty_id)
    {
        $get_semester_duration = $request->input('year');

        $get_semester_data_array = Semester::where('faculty_id', $faculty_id)->get();

        $pluck_semesterid_semester = Arr::pluck($get_semester_data_array, ['semester_id']);
        $id = implode(" ", $pluck_semesterid_semester);

      
        if ($id == !null) {
            $get_id_semester = DB::table('semesters')->where('semester_id', $id)->get();
            $pluck_levelid_semester = Arr::pluck($get_id_semester, ['level_id']);
            $pluck_semesterid_semester = Arr::pluck($get_id_semester, ['semester_id']);
            $pluck_facultyid_semester = Arr::pluck($get_id_semester, ['faculty_id']);

            $implode_levelid_semester = implode(" ", $pluck_levelid_semester);
            $implode_semesterid_semester = implode(" ", $pluck_semesterid_semester);
            $implode_facultyid_semester = implode(" ", $pluck_facultyid_semester);
        } else {
            $get_id_semester = DB::table('faculties')->where('faculty_id', $faculty_id)->get();
            $pluck_levelid_semester = Arr::pluck($get_id_semester, ['level_id']);
            $pluck_facultyid_semester = Arr::pluck($get_id_semester, ['faculty_id']);

            $implode_levelid_semester = implode(" ", $pluck_levelid_semester);
            $implode_facultyid_semester = implode(" ", $pluck_facultyid_semester);
        }

        $get_subject = $request->input('subject');

        $subjects = new Subject;
        if ($id == !null) {
            $subjects->semester_id = $implode_semesterid_semester;
        }
        $subjects->level_id = $implode_levelid_semester;
        $subjects->faculty_id = $implode_facultyid_semester;
        $subjects->subject_title = $get_subject;
        $subjects->semester_choosen = $get_semester_duration;
        $subjects->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subject_id)
    {
        $get_semester_duration = $request->input('year');

        $get_semester_data_array = Subject::where('subject_id', $subject_id)->get();

        $pluck_semesterid_semester = Arr::pluck($get_semester_data_array, ['semester_id']);
        $pluck_facultyid = Arr::pluck($get_semester_data_array, ['faculty_id']);
        $faculty_id = implode(" ", $pluck_facultyid);

        $id = implode(" ", $pluck_semesterid_semester);

        // if ($id == !null) {
        //     $get_id_semester = DB::table('semesters')->where('semester_id', $id)->get();
        //     $pluck_levelid_semester = Arr::pluck($get_id_semester, ['level_id']);
        //     $pluck_semesterid_semester = Arr::pluck($get_id_semester, ['semester_id']);
        //     $pluck_facultyid_semester = Arr::pluck($get_id_semester, ['faculty_id']);

        //     $implode_levelid_semester = implode(" ", $pluck_levelid_semester);
        //     $implode_semesterid_semester = implode(" ", $pluck_semesterid_semester);
        //     $implode_facultyid_semester = implode(" ", $pluck_facultyid_semester);
        // } else {
        //     $get_id_semester = DB::table('faculties')->where('faculty_id', $faculty_id)->get();
        //     $pluck_levelid_semester = Arr::pluck($get_id_semester, ['level_id']);
        //     $pluck_facultyid_semester = Arr::pluck($get_id_semester, ['faculty_id']);

        //     $implode_levelid_semester = implode(" ", $pluck_levelid_semester);
        //     $implode_facultyid_semester = implode(" ", $pluck_facultyid_semester);
        // }

        $get_subject = $request->input('subject');

        $subjects = Subject::find($subject_id);
        $subjects->subject_title = $get_subject;
        $subjects->semester_choosen = $get_semester_duration;
        $subjects->save();

        return \Redirect::route('getsubjectsIndex',$faculty_id)->with('updatesuccess', 'Subject is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editsubjectsDetails($subject_id)
    {
        $get_subject_data_array = Subject::where('subject_id', $subject_id)->get();
        $pluck_semesterid_semester = Arr::pluck($get_subject_data_array, ['semester_id']);
        $semester_id = implode(" ", $pluck_semesterid_semester);

        $get_semester_data = Semester::where('semester_id', $semester_id)->first();
        $get_subject_data = Subject::where('subject_id', $subject_id)->first();

        return view('editsubjects')->with('get_semester_data', $get_semester_data)
            ->with('get_subject_data', $get_subject_data);
    }

    public function delsubjectsDetails($id)
    {
        if (Chapter::where('subject_id', $id)->exists()) {
            return redirect()->back()->with('violation', 'Cannot delete faculty: Chapters exists');
        } else {
            Subject::find($id)->delete();
            return redirect()->back();
        }
    }

    public function getsubjectsSearch(Request $request, $faculty_id)
    {
        $get_faculty_data_array = Faculty::where('faculty_id', $faculty_id)->get();
        $pluck_levelid_faculty = Arr::pluck($get_faculty_data_array, ['level_id']);
        $level_id = implode(" ", $pluck_levelid_faculty);


            if (Semester::where('faculty_id', $faculty_id)->first() == null) {
                $get_semester_data = Faculty::where('faculty_id', $faculty_id)->first();
            } else {
                $get_semester_data = Semester::where('faculty_id', $faculty_id)->first();
            }

            $get_faculty_data = Faculty::where('faculty_id', $faculty_id)->first();

            $get_faculty_data_level_title = Faculty::where('faculty_id', $faculty_id)->get();

            $get_semester_data_array = Semester::where('faculty_id', $faculty_id)->get();
            $pluck_semesterid_semester = Arr::pluck($get_semester_data_array, ['semester_id']);
            $semester_id = implode(" ", $pluck_semesterid_semester);

            $get_subject_data = DB::table('subjects')->where('faculty_id', $faculty_id)->get();
            $pluck_level_id = Arr::pluck($get_faculty_data_level_title, ['level_id']);
            $level_id = implode(" ", $pluck_level_id);
            $level_title = Level::where('level_id', $level_id)->first();

            $query = $request->input('q');
            if ($query != '') {
                $get_subject_data = DB::table('subjects')->where('subject_title', 'like', '%' . $query . '%')->where('faculty_id',"=",$faculty_id)->get();
                if($get_subject_data->count() == 0){
                    return redirect()->back()->with('searchnotfound', 'Sorry the search item doesnot exist');
                }
            } else {
                $get_subject_data = DB::table('subjects')->where('faculty_id',"=",$faculty_id)
                    ->get();
            }

            return view('subjects')->with('get_semester_data', $get_semester_data)
            ->with('get_subject_data', $get_subject_data)->with('get_faculty_data', $get_faculty_data)
            ->with('level_title', $level_title);
    }
}
