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

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $chapter_id)
    {
        $get_chapter_data = Chapter::where('chapter_id', $chapter_id)->first();

        $get_chapter_data_array = Chapter::where('chapter_id', $chapter_id)->get();
        $pluck_facultyid_chapter = Arr::pluck($get_chapter_data_array, ['faculty_id']);
        $pluck_subjectid_chapter = Arr::pluck($get_chapter_data_array, ['subject_id']);
        $pluck_chapterid_chapter = Arr::pluck($get_chapter_data_array, ['chapter_id']);

        $implode_facultyid_chapter = implode(" ", $pluck_facultyid_chapter);
        $implode_subjectid_chapter = implode(" ", $pluck_subjectid_chapter);
        $implode_chapterid_chapter = implode(" ", $pluck_chapterid_chapter);

        $get_faculty_title = Faculty::where('faculty_id', $implode_facultyid_chapter)->first();
        $get_subject_title = Subject::where('subject_id', $implode_subjectid_chapter)->first();
        $get_chapter_title = Chapter::where('faculty_id', $implode_chapterid_chapter)->first();

        $get_content_data_array = DB::table('contents')->where('chapter_id', $chapter_id)->get();

        $pluck_level_id = Arr::pluck($get_chapter_data_array, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        return view('contents')->with('get_chapter_data', $get_chapter_data)
            ->with('get_content_data_array', $get_content_data_array)->with('get_faculty_title', $get_faculty_title)
            ->with('get_subject_title', $get_subject_title)
            ->with('get_chapter_title', $get_chapter_title)
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
    public function store(Request $request, $chapter_id)
    {
   

        $get_id_chapter = DB::table('chapters')->where('chapter_id', $chapter_id)->get();

        $pluck_levelid_chapter = Arr::pluck($get_id_chapter, ['level_id']);
        $pluck_semesterid_chapter = Arr::pluck($get_id_chapter, ['semester_id']);
        $pluck_facultyid_chapter = Arr::pluck($get_id_chapter, ['faculty_id']);
        $pluck_subjectid_chapter = Arr::pluck($get_id_chapter, ['subject_id']);
        $pluck_chapterid_chapter = Arr::pluck($get_id_chapter, ['chapter_id']);

        $implode_levelid_chapter = implode(" ", $pluck_levelid_chapter);
        $implode_semesterid_chapter = implode(" ", $pluck_semesterid_chapter);
        $implode_facultyid_chapter = implode(" ", $pluck_facultyid_chapter);
        $implode_subjectid_chapter = implode(" ", $pluck_subjectid_chapter);
        $implode_chapterid_chapter = implode(" ", $pluck_chapterid_chapter);

        $audios = $request->file('audio');
        $audios_count = count($audios);

        $uploadcount = 0;

        if ($request->file('audio') == !null) {
            foreach ($audios as $audio) {
                // $destinationPath = 'audios';

                $uniquecontent = sha1(time());
                $file = $audio->getClientOriginalName();
                $info = pathinfo($file);
                // from PHP 5.2.0 :
                $file_name = $info['filename'];
               
               
                // $upload_success = $audio->move($destinationPath, $filename);

                $getExtension = $audio->getClientOriginalExtension();
                $nameofcontent = $uniquecontent . '.' . $getExtension;
                $audio->move('audios/', $nameofcontent);

                $contents = new Content;

                $contents->level_id = $implode_levelid_chapter;

                if ($implode_semesterid_chapter == !null) {
                    $contents->semester_id = $implode_semesterid_chapter;
                }

                $contents->faculty_id = $implode_facultyid_chapter;
                $contents->subject_id = $implode_subjectid_chapter;
                $contents->chapter_id = $implode_chapterid_chapter;

                // if ($getExtension == "wav") {
                $contents->content_type = $file_name;
                // }

                $contents->content_title = $nameofcontent;
                $contents->save();
                $uploadcount++;

            }
            return redirect()->back();
        }
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

    public function delcontentsDetails($id)
    {
        $findaudio = Content::findOrFail($id);
        $file_path = public_path() . "/audios/" . $findaudio->content_title;
        unlink($file_path);
        $findaudio->delete();
        return redirect()->back();
    }
}
