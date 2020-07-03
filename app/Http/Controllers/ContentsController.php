<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Content;
use App\Faculty;
use App\Level;
use App\Preferences;
use App\Subject;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $subject_id)
    {

        $get_subject_data = Subject::where('subject_id', $subject_id)->first();

        $get_subject_data_array = Subject::where('subject_id', $subject_id)->get();

        $pluck_facultyid_subject = Arr::pluck($get_subject_data_array, ['faculty_id']);
        $pluck_subjectid_subject = Arr::pluck($get_subject_data_array, ['subject_id']);

        $implode_facultyid = implode(" ", $pluck_facultyid_subject);
        $implode_subjectid = implode(" ", $pluck_subjectid_subject);

        $get_faculty_title = Faculty::where('faculty_id', $implode_facultyid)->first();
        $get_subject_title = Subject::where('subject_id', $implode_subjectid)->first();

        $get_content_data_array = DB::table('contents')->where('subject_id', $subject_id)->get();

        $pluck_level_id = Arr::pluck($get_subject_data_array, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);

        $level_title = Level::where('level_id', $level_id)->first();

        return view('contents')->with('get_subject_data', $get_subject_data)
            ->with('get_content_data_array', $get_content_data_array)->with('get_faculty_title', $get_faculty_title)
            ->with('get_subject_title', $get_subject_title)
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

        $audios = $request->file('audio');
        // if(count($audios)>=5){
        //     return redirect()->back()->with('contentuploadexceeded', 'Cannot upload more than 4 items at a time');
        // }

        $uploadcount = 0;
        $uniquecontent = array();

        if ($request->file('audio') == !null) {
            foreach ($audios as $audio) {
                // $destinationPath = 'audios';

                $uniquecontent = (string) Str::uuid();
                $file = $audio->getClientOriginalName();
                $info = pathinfo($file);

                // from PHP 5.2.0 :
                $file_name = $info['filename'];

                //aready a comment
                // $upload_success = $audio->move($destinationPath, $filename);

                $getExtension = $audio->getClientOriginalExtension();
                $nameofcontent = $uniquecontent . '.' . $getExtension;

                $audio->move('audios/', $nameofcontent);

                $contents = new Content;

                $contents->level_id = $implode_levelid_subject;

                if ($implode_semesterid_subject == !null) {
                    $contents->semester_id = $implode_semesterid_subject;
                }

                $contents->faculty_id = $implode_facultyid_subject;
                $contents->subject_id = $implode_subjectid_subject;

                $contents->content_name = $file_name;

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
    public function update(Request $request, $content_id)
    {
        $get_content_data_array = Content::where('content_id', $content_id)->get();
        $pluck_subjectid = Arr::pluck($get_content_data_array, ['subject_id']);
        $subject_id = implode(" ", $pluck_subjectid);

        $get_content = $request->input('content');
        $contents = Content::find($content_id);

        $contents->content_name = $get_content;
        $contents->save();
        return \Redirect::route('getcontentsIndex', $subject_id)->with('updatesuccess', 'Content is updated successfully');
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

    public function delcontentsDetails(Request $request, $id)
    {

        //  deleting from favourite if exists
        $preferences_array = DB::table('preferences')->get();
        if (count($preferences_array) > 0) {

            $json_all_favourite_ids = DB::table('preferences')->pluck('student_favourite')->toArray();

            $json_all_student_ids = DB::table('preferences')->pluck('student_id')->toArray();

            $increment = null;

            foreach (array_combine($json_all_favourite_ids, $json_all_student_ids) as $student_favourite => $student_id) {
                $favourite_single = json_decode($student_favourite);

                $single_collection = collect(array_diff($favourite_single, array($id)))->values()->all();

                $editfavourite = Preferences::where('student_id', $student_id)->first();
                $editfavourite->student_favourite = json_encode($single_collection);
                $editfavourite->save();
            }
        }

        $findaudio = Content::findOrFail($id);
        $file_path = public_path() . "/audios/" . $findaudio->content_title;
        unlink($file_path);
        $findaudio->delete();

        return redirect()->back();
    }

    public function delcontentsdetailsAll(Request $request, $subject_id){
        $findallcontents = DB::table('contents')->where('subject_id',$subject_id)->get();

        foreach ($findallcontents as $findaudio){
            $file_path = public_path() . "/audios/" . $findaudio->content_title;
            unlink($file_path);
            $delete_audio = Content::where('content_id',$findaudio->content_id)->delete();
        }

        return redirect()->back();
    }

    public function editcontentsDetails($content_id)
    {
        $get_content_data = Content::where('content_id', $content_id)->first();
        return view('editcontents')->with('get_content_data', $get_content_data);
    }

    public function getcontentsSearch(Request $request, $subject_id)
    {
        $get_subject_data = Subject::where('subject_id', $subject_id)->first();

        $get_subject_data_array = Subject::where('subject_id', $subject_id)->get();
        $pluck_facultyid_subject = Arr::pluck($get_subject_data_array, ['faculty_id']);
        $pluck_subjectid_subject = Arr::pluck($get_subject_data_array, ['subject_id']);
        
        $implode_facultyid_subject = implode(" ", $pluck_facultyid_subject);
        $implode_subjectid_subject = implode(" ", $pluck_subjectid_subject);

        $get_faculty_title = Faculty::where('faculty_id', $implode_facultyid_subject)->first();
        $get_subject_title = Subject::where('subject_id', $implode_subjectid_subject)->first();

        $get_content_data_array = DB::table('contents')->where('subject_id', $subject_id)->get();

        $pluck_level_id = Arr::pluck($get_subject_data_array, ['level_id']);
        $level_id = implode(" ", $pluck_level_id);
        $level_title = Level::where('level_id', $level_id)->first();

        $query = $request->input('q');
        if ($query != '') {
            $get_content_data_array = DB::table('contents')->where('content_name', 'like', '%' . $query . '%')->where('subject_id', "=", $subject_id)->get();
            if ($get_content_data_array->count() == 0) {
                return redirect()->back()->with('searchnotfound', 'Sorry the search item doesnot exist');
            }
        } else {
            $get_content_data_array = DB::table('contents')->where('subject_id', "=", $subject_id)
                ->get();
        }

        return view('contents')->with('get_subject_data', $get_subject_data)
            ->with('get_content_data_array', $get_content_data_array)->with('get_faculty_title', $get_faculty_title)
            ->with('get_subject_title', $get_subject_title)
            ->with('level_title', $level_title);
    }
}
