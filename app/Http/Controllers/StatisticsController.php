<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function Statistics()
    {
        $statistics = DB::table('students')->get();
        return view('statistics')->with('statistics', $statistics);
    }

    public function sortbyname()
    {
        $statistics = DB::table('students')->orderby('name', 'ASC')->get();
        $sortbyname = 'Sorting by name';
        return view('statistics')->with('statistics', $statistics)->with('sortbyname', $sortbyname);
    }

    public function sortbylevel(Request $request)
    {
            $statistics = DB::table('students')->where('level', '=', $request->level)->get();
            return view('statistics')->with('statistics', $statistics);

    }

    // public function sortbymale()
    // {
    //     $statistics = DB::table('students')->where('gender', '=', 'male')->get();
    //     $sortbymale = 'Sorting by male';
    //     return view('statistics')->with('statistics', $statistics)->with('sortbymale', $sortbymale);
    // }

    // public function sortbyfemale()
    // {
    //     $statistics = DB::table('students')->where('gender', '=', 'female')->get();
    //     $sortbyfemale = 'Sorting by female';
    //     return view('statistics')->with('statistics', $statistics)->with('sortbyfemale', $sortbyfemale);
    // }

    // public function sortbyfullblind()
    // {
    //     $statistics = DB::table('students')->where('type', '=', 'fullblind')->get();
    //     $sortbyfullblind = 'Sorting by full blind';
    //     return view('statistics')->with('statistics', $statistics)->with('sortbyfullblind', $sortbyfullblind);
    // }

    // public function sortbyhalfblind()
    // {
    //     $statistics = DB::table('students')->where('type', '=', 'halfblind')->get();
    //     $sortbyhalfblind = 'Sorting by half blind';
    //     return view('statistics')->with('statistics', $statistics)->with('sortbyhalfblind', $sortbyhalfblind);
    // }

    // public function sortbyage(Request $request)
    // {
    //     if ($request->form && $request->to == !null) {
    //         $get_firstrange = $request->from;
    //         $get_secondrange = $request->to;
    //         $statistics = DB::table('students')->where('age', '>', $get_firstrange)->where('age', '<', $get_secondrange)->get();
    //         return view('statistics')->with('statistics', $statistics);
    //     }
    //     else {
    //         return redirect()->back();
    //     }
    // }

    // public function sortbyagebetween25and35()
    // {
    //     $statistics = DB::table('students')->where('age','>', 25)->where('age','<', 35)->get();
    //     $sortbyagebetween25and35 = 'Sorting by age between 25 and 35';
    //     return view('statistics')->with('statistics',$statistics)->with('sortbyagebetween25and35',$sortbyagebetween25and35);
    // }

    // public function sortbyageabove35()
    // {
    //     $statistics = DB::table('students')->where('age','>', 35)->get();
    //     $sortbyageabove35 = 'Sorting by age above 35';
    //     return view('statistics')->with('statistics',$statistics)->with('sortbyageabove35',$sortbyageabove35);
    // }
}
