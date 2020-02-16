<?php

namespace App\Http\Controllers;
use App\Faculty;
use App\Level;
use App\Semester;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_level_data= Level::all();
        return view('levels')->with('get_level_data',$get_level_data);
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
        //
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

    public function getlevelsSearch(Request $request)
    {
        $query = $request->input('q');
        if ($query != '') {
            $get_level_data = DB::table('levels')->where('level_title', 'like', '%' . $query . '%')->get();
            if($get_level_data->count() == 0){
                return redirect()->back()->with('searchnotfound', 'Sorry the search item doesnot exist');
            }
        } else {
            $get_level_data = DB::table('levels')
                ->orderBy('level_title', 'desc')
                ->get();
        }
       
        return view('levels')->with('get_level_data', $get_level_data);
    }
}
