<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Content;
use App\Faculty;
use App\Level;
use App\Subject;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $subject_id)
    {

        $get_subject_data = Subject::where('subject_id', $subject_id)->first();

        $get_subject_data_level_id = Subject::where('subject_id', $subject_id)->get();
        $pluck_level_id = Arr::pluck($get_subject_data_level_id, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        $get_subject_data_array = Chapter::where('subject_id', $subject_id)->get();
        $pluck_facultyid_subject = Arr::pluck($get_subject_data_level_id, ['faculty_id']);

        $implode_facultyid_subject = implode("", $pluck_facultyid_subject);
        $get_faculty_data = Faculty::where('faculty_id', $implode_facultyid_subject)->first();

        return view('chapters')->with('get_subject_data', $get_subject_data)->with('get_subject_data_array', $get_subject_data_array)
            ->with('get_faculty_data', $get_faculty_data)->with('level_title', $level_title);
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
    public function store(Request $request, $subject_id)
    {
        $get_id_subject = DB::table('subjects')->where('subject_id', $subject_id)->get();

        $pluck_levelid_subject = Arr::pluck($get_id_subject, ['level_id']);
        $pluck_semesterid_subject = Arr::pluck($get_id_subject, ['semester_id']);
        $pluck_facultyid_subject = Arr::pluck($get_id_subject, ['faculty_id']);
        $pluck_subjectid_subject = Arr::pluck($get_id_subject, ['subject_id']);

        $implode_levelid_subject = implode(" ", $pluck_levelid_subject);
        $implode_semesterid_subject = implode(" ", $pluck_semesterid_subject);
        $implode_facultyid_subject = implode(" ", $pluck_facultyid_subject);
        $implode_subjectid_subject = implode(" ", $pluck_subjectid_subject);

        $get_chapter = $request->input('chapter');

        $chapters = new Chapter;
        $chapters->level_id = $implode_levelid_subject;

        if ($implode_semesterid_subject == !null) {
            $chapters->semester_id = $implode_semesterid_subject;
        }

        $chapters->faculty_id = $implode_facultyid_subject;
        $chapters->subject_id = $implode_subjectid_subject;
        $chapters->chapter_title = $get_chapter;
        $chapters->save();
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
    public function update(Request $request, $chapter_id)
    {

        $get_chapter_data_array = Chapter::where('chapter_id', $chapter_id)->get();
        $pluck_subjectid = Arr::pluck($get_chapter_data_array, ['subject_id']);
        $subject_id = implode(" ", $pluck_subjectid);

        $get_chapter = $request->input('chapter');
        $chapters = Chapter::find($chapter_id);

        $chapters->chapter_title = $get_chapter;
        $chapters->save();
        return \Redirect::route('getchaptersIndex', $subject_id)->with('updatesuccess', 'Chapter is updated successfully');
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

    public function delchaptersDetails($id)
    {
        if (Content::where('chapter_id', $id)->exists()) {
            return redirect()->back()->with('violation', 'Cannot delete chapter: Contents exists');
        } else {
            Chapter::find($id)->delete();
            return redirect()->back();
        }
    }

    public function editchaptersDetails($chapter_id)
    {
        $get_chapter_data = Chapter::where('chapter_id', $chapter_id)->first();
        return view('editchapters')->with('get_chapter_data', $get_chapter_data);
    }

    public function getchaptersSearch(Request $request, $subject_id)
    {

        $get_subject_data = Subject::where('subject_id', $subject_id)->first();

        $get_subject_data_level_id = Subject::where('subject_id', $subject_id)->get();
        $pluck_level_id = Arr::pluck($get_subject_data_level_id, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        $get_subject_data_array = Chapter::where('subject_id', $subject_id)->get();
        $pluck_facultyid_subject = Arr::pluck($get_subject_data_level_id, ['faculty_id']);

        $implode_facultyid_subject = implode(" ", $pluck_facultyid_subject);
        $get_faculty_data = Faculty::where('faculty_id', $implode_facultyid_subject)->first();

        $query = $request->input('q');
        if ($query != '') {
            $get_subject_data_array = DB::table('chapters')->where('chapter_title', 'like', '%' . $query . '%')->where('subject_id', "=", $subject_id)->get();
            if ($get_subject_data_array->count() == 0) {
                return redirect()->back()->with('searchnotfound', 'Sorry the search item doesnot exist');
            }
        } else {
            $get_subject_data_array = DB::table('chapters')->where('subject_id', "=", $subject_id)
                ->get();
        }

        return view('chapters')->with('get_subject_data', $get_subject_data)->with('get_subject_data_array', $get_subject_data_array)
            ->with('get_faculty_data', $get_faculty_data)->with('level_title', $level_title);
    }
}
