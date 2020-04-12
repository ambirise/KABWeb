<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use App\Imports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;


class MyController extends Controller
{
    public function export()
    {
        return Excel::download(new StudentsExport, 'students details.xlsx');
    }

}