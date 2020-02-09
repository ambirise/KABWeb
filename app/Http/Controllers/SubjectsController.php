<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use App\Subject;
use DB;
use Illuminate\Support\Arr;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request,$semester_id)
    {
        $get_semester_data = Semester::where('semester_id', $semester_id)->first();

        $get_subject_data= DB::table('subjects')->where('semester_id',$semester_id)->get();
        
        return view('subjects')->with('get_semester_data',$get_semester_data)
        ->with('get_subject_data',$get_subject_data);
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
    public function store(Request $request,$semester_id)
    {

        $get_id_semester = DB::table('semesters')->where('semester_id',$semester_id)->get();
        $pluck_levelid_semester=Arr::pluck($get_id_semester,['level_id']);
        $pluck_semesterid_semester=Arr::pluck($get_id_semester,['semester_id']);
        $pluck_facultyid_semester=Arr::pluck($get_id_semester,['faculty_id']);

        $implode_levelid_semester = implode(" ",$pluck_levelid_semester);
        $implode_semesterid_semester = implode(" ",$pluck_semesterid_semester);
        $implode_facultyid_semester = implode(" ",$pluck_facultyid_semester);
        
        $get_subject= $request->input('subject');

        $subjects = new Subject;
        $subjects -> level_id = $implode_levelid_semester;
        $subjects -> semester_id = $implode_semesterid_semester;
        $subjects -> faculty_id = $implode_facultyid_semester;
        $subjects -> subject_title = $get_subject;
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
