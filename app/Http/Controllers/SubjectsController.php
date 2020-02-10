<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Semester;
use App\Subject;
use App\Level;
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
        $get_semester_data = Faculty::where('faculty_id', $faculty_id)->first();
        $get_faculty_data = Faculty::where('faculty_id', $faculty_id)->first();

        $get_semester_data_array = Semester::where('faculty_id', $faculty_id)->get();
        $pluck_semesterid_semester = Arr::pluck($get_semester_data_array, ['semester_id']);
        $semester_id = implode(" ", $pluck_semesterid_semester);

        $get_subject_data = DB::table('subjects')->where('faculty_id', $faculty_id)->get();
        $pluck_level_id = Arr::pluck($get_subject_data, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        return view('subjects')->with('get_semester_data', $get_semester_data)
            ->with('get_subject_data', $get_subject_data)->with('get_faculty_data', $get_faculty_data)
            ->with('level_title', $level_title);
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

            // $get_id_faculty = DB::table('semesters')->where('semester_id',$semester_id)->get();
            // $pluck_id_faculty=Arr::pluck($get_id_faculty,['semester_id']);
            // $implode_id_faculty = implode(" ",$pluck_id_faculty);

            // $id=$implode_id_faculty;

            $editSemesters = Semester::find($id);
            $editSemesters->semester_title = $get_semester_duration;
            $editSemesters->save();
        }

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
    public function update(Request $request, $id)
    {
        //
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
}
