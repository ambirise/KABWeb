<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Content;
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

        $get_content_data_array = DB::table('contents')->where('chapter_id', $chapter_id)->get();

        return view('contents')->with('get_chapter_data', $get_chapter_data)
            ->with('get_content_data_array', $get_content_data_array);
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
        $typeofcontent = "Audio";
        $uploadcount = 0;

        if ($request->file('audio') == !null) {
            foreach ($audios as $audio) {
                $destinationPath = 'audios';
                $filename = $audio->getClientOriginalName();
                $upload_success = $audio->move($destinationPath, $filename);

                $contents = new Content;

                $contents->level_id = $implode_levelid_chapter;
                $contents->semester_id = $implode_semesterid_chapter;
                $contents->faculty_id = $implode_facultyid_chapter;
                $contents->subject_id = $implode_subjectid_chapter;
                $contents->chapter_id = $implode_chapterid_chapter;

                // if ($getExtension == "wav") {
                    $contents->content_type = "Audio";
                // }

                $contents->content_title = $filename;
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

}
