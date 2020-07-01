<?php

namespace App\Imports;

use App\Student;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection()
    {
        return Student::all();
    }

    public function headings():array
    {
        return [
            'Student Id',
            'Name',
            'Phone Number',
            'Level',
            'Created At',
            'Updated At',
        ];
    }
}
