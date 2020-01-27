<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $get_data = Level::all()->map->only(['level_title']);
        $get_school=$get_data[0]['level_title'];  // get School String
        $get_bachelor=$get_data[1]['level_title'];  // get Bachelor String
        $get_10plus2=$get_data[2]['level_title'];  // get 10+2 String
        $get_loksewa=$get_data[3]['level_title'];  // get Loksewa String
        return view('index')->with('get_school',$get_school)->with('get_bachelor',$get_bachelor)
        ->with('get_10plus2',$get_10plus2)->with('get_loksewa',$get_loksewa);
    }
}
