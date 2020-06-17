<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\Level;
use App\Semester;
use DB;
use Illuminate\Support\Arr;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request,$faculty_id)
    {
        $get_semester_data = Semester::where('faculty_id', $faculty_id)->first();
        
        return view('semesters')->with('get_semester_data', $get_semester_data);
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
    public function store(Request $request,$faculty_id)
    {
        $get_semester_duration= $request->input('year');

        $get_id_faculty = DB::table('semesters')->where('faculty_id',$faculty_id)->get();
        $pluck_id_faculty=Arr::pluck($get_id_faculty,['semester_id']);

        $implode_id_faculty = implode(" ",$pluck_id_faculty);
        
        $id=$implode_id_faculty;

        dd($semester_title);

        $editSemesters = Semester::find($id);
        $editSemesters->semester_title = $get_semester_duration;
        $editSemesters->save();
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
