<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Faculty;
use DB;


class FacultiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_data = Level::all()->map->only(['level_id']);

        $get_faculty_data =  DB::table('faculties')->join('levels', 'faculties.level_id', '=', 'levels.level_id')->get();

        $get_school=$get_data[0]['level_id'];  // get School String
        $get_bachelor=$get_data[1]['level_id'];  // get Bachelor String
        $get_10plus2=$get_data[2]['level_id'];  // get 10+2 String
        $get_loksewa=$get_data[3]['level_id'];  // get Loksewa String
        return view('faculties')->with('get_school',$get_school)->with('get_bachelor',$get_bachelor)
        ->with('get_10plus2',$get_10plus2)->with('get_loksewa',$get_loksewa)->with('get_faculty_data',$get_faculty_data);
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
    public function store(Request $request)
    {
        $levelchoose = $request->input('levelchoose');
        $faculty = $request->input('faculty');

        $year = $request->input('year');
        $semester = $request->input('semester');

        $numberofyear = $request->input('numberofyear');
        $numberofsemester = $request->input('numberofsemester');
      
        dd($year);

        $faculties = new Faculty;
        $faculties->level_id = $levelchoose;
        $faculties->faculty_title= $faculty;
        $faculties->save();
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
        echo "this";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Faculty::where('faculty_id', $id)->delete();
        return redirect()->back();
    }

    public function editfacultiesDetails($id){
        $facultiesdetails=  Faculty::where('faculty_id', $id)->first();

        $get_data = Level::all()->map->only(['level_id']);

        $get_school=$get_data[0]['level_id'];  // get School String
        $get_bachelor=$get_data[1]['level_id'];  // get Bachelor String
        $get_10plus2=$get_data[2]['level_id'];  // get 10+2 String
        $get_loksewa=$get_data[3]['level_id'];  // get Loksewa String

        return view('editfaculties')->with('facultiesdetails',$facultiesdetails)
        ->with('get_school',$get_school)->with('get_bachelor',$get_bachelor)
        ->with('get_10plus2',$get_10plus2)->with('get_loksewa',$get_loksewa);
    }


}
