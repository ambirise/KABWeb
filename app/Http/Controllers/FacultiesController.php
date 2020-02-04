<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Level;
use App\Semester;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FacultiesController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$level_id)
    { 
        $get_level_data = Level::where('level_id', $level_id)->first();
        
        // if ($query != '') {
        //     $data = DB::table('faculties')->where('faculty_title', 'like', '%' . $query . '%')->get();
        // } else {
        //     $data = DB::table('faculties')
        //         ->orderBy('faculty_title', 'desc')
        //         ->get();
        // }

     
        $get_data = Level::all()->map->only(['level_id']);

        $get_faculty_data = DB::table('faculties')->join('levels', 'faculties.level_id', '=', 'levels.level_id')->get();

        $get_school = $get_data[0]['level_id']; // get School String
        $get_bachelor = $get_data[1]['level_id']; // get Bachelor String
        $get_10plus2 = $get_data[2]['level_id']; // get 10+2 String
        $get_loksewa = $get_data[3]['level_id']; // get Loksewa String
        return view('faculties')->with('get_school', $get_school)->with('get_bachelor', $get_bachelor)
            ->with('get_10plus2', $get_10plus2)->with('get_loksewa', $get_loksewa)->with('get_faculty_data', $get_faculty_data)
            ->with('get_level_data',$get_level_data)->with('level_id',$level_id);
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
        $levelid= $request->input('levelid');
        
        if($request->input('facultybachelor')==null){
            $faculty = $request->input('facultyschool');
        }
        else{
            $faculty = $request->input('facultybachelor');
            $yearorsemester = $request->input('Semester');
            $numberofyear = $request->input('numberofyear');
            $numberofsemester = $request->input('numberofsemester');
        }
       
        
        //for reuse
        // $year = $request->input('year');
        // $semester = $request->input('semester');

        $faculties = new Faculty;
       
        $faculties->level_id = $levelid;
        if($request->input('facultybachelor')==null){
            $faculties->faculty_title = $faculty;
        }
        else{
        $faculties->faculty_title = $faculty;
        // $faculties->yearorsemester = $yearorsemester;
        // $faculties->numberofsemester = $numberofsemester;
        // $faculties->numberofyear = $numberofyear;
        }

  
        $faculties->save();

        // Get data for inserting into the semester
        $level_id_semester= $faculties->level_id;
        $faculty_id_semester= $faculties->faculty_id;
      
        //For inserting into semester
        $semesters = new Semester;
        $semesters->level_id = $level_id_semester;
        $semesters->faculty_id = $faculty_id_semester;
        
        $semesters->yearorsemester = $yearorsemester;
        $semesters->numberofsemester = $numberofsemester;
        $semesters->numberofyear = $numberofyear;
        
        $semesters->save();
        
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
        $levelchoose = $request->input('levelchoose');
        if($request->input('facultybachelor')==null){
            $faculty = $request->input('facultyschool');
        }
        else{
            $faculty = $request->input('facultybachelor');
            $yearorsemester = $request->input('Semester');
            $numberofyear = $request->input('numberofyear');
            $numberofsemester = $request->input('numberofsemester');
        }
        $editfaculties = Faculty::find($id);
        dd($editfaculties);
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

    public function editfacultiesDetails($id)
    {
        $facultiesdetails = Faculty::where('faculty_id', $id)->first();
    
        $facultiesdetails_db= DB::table('faculties')->where('faculty_id',$id)->get();
     
        $pluckleveldetailsid =Arr::pluck($facultiesdetails_db,['level_id']);
        $implode_leveldetailsid = implode(" ",$pluckleveldetailsid);

        $leveldetails_db= DB::table('levels')->where('level_id',$implode_leveldetailsid)->get();

        $pluckleveldetailstitle =Arr::pluck($leveldetails_db,['level_title']);
        $implode_leveldetailstitle = implode(" ",$pluckleveldetailstitle);
      
      
        //    Unused code for delete
        // $leveldetails = Level::where('level_id', $id)->get();
        // $pluckleveldetailstitle =Arr::pluck($leveldetails,['level_title']);
        // $pluckleveldetailsid =Arr::pluck($leveldetails,['level_id']);
        // $implode_leveldetailstitle = implode(" ",$pluckleveldetailstitle);
        // $implode_leveldetailsid = implode(" ",$pluckleveldetailsid);
     
        

        $get_data = Level::all()->map->only(['level_id']);

        $get_school = $get_data[0]['level_id']; // get School String
        $get_bachelor = $get_data[1]['level_id']; // get Bachelor String
        $get_10plus2 = $get_data[2]['level_id']; // get 10+2 String
        $get_loksewa = $get_data[3]['level_id']; // get Loksewa String

        return view('editfaculties')->with('facultiesdetails', $facultiesdetails)
            ->with('get_school', $get_school)->with('get_bachelor', $get_bachelor)
            ->with('get_10plus2', $get_10plus2)->with('get_loksewa', $get_loksewa)
            ->with('implode_leveldetailstitle',$implode_leveldetailstitle)
            ->with('implode_leveldetailsid',$implode_leveldetailsid);
    }

    public function getfacultiesSearch(Request $request,$level_id)
    {
        if ($level_id == 3){
        $get_level_data = Level::where('level_id', $level_id)->first();
       
        $get_data = Level::all()->map->only(['level_id']);
        $get_school = $get_data[0]['level_id']; // get School String
        $get_bachelor = $get_data[1]['level_id']; // get Bachelor String
        $get_10plus2 = $get_data[2]['level_id']; // get 10+2 String
        $get_loksewa = $get_data[3]['level_id']; // get Loksewa String
        $query = $request->input('q');
        if ($query != '') {
            $get_faculty_data = DB::table('faculties')->where('faculty_title', 'like', '%' . $query . '%')->get();
        } else {
            $get_faculty_data = DB::table('faculties')
                ->orderBy('faculty_title', 'desc')
                ->get();
        }

        return view('faculties')->with('get_faculty_data',$get_faculty_data)
        ->with('get_school', $get_school)->with('get_bachelor', $get_bachelor)
        ->with('get_10plus2', $get_10plus2)->with('get_loksewa', $get_loksewa)
        ->with('get_level_data',$get_level_data)->with('level_id',$level_id);
    }
    if ($level_id ==1){
        $get_level_data = Level::where('level_id', $level_id)->first();
       
        $get_data = Level::all()->map->only(['level_id']);
        $get_school = $get_data[0]['level_id']; // get School String
        $get_bachelor = $get_data[1]['level_id']; // get Bachelor String
        $get_10plus2 = $get_data[2]['level_id']; // get 10+2 String
        $get_loksewa = $get_data[3]['level_id']; // get Loksewa String
        $query = $request->input('q');
        if ($query != '') {
            $get_faculty_data = DB::table('faculties')->where('faculty_title', 'like', '%' . $query . '%')->get();
        } else {
            $get_faculty_data = DB::table('faculties')
                ->orderBy('faculty_title', 'desc')
                ->get();
        }

        return view('faculties')->with('get_faculty_data',$get_faculty_data)
        ->with('get_school', $get_school)->with('get_bachelor', $get_bachelor)
        ->with('get_10plus2', $get_10plus2)->with('get_loksewa', $get_loksewa)
        ->with('get_level_data',$get_level_data)->with('level_id',$level_id);
    }
    }
}
