<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Doctor::select('id','name','email','phone','specialization','membershipLevel','status')->get();
    }

    public function headings(): array
    {
        return ['ID','Name','Email','Phone','Specialization','Membership Level','Status'];
    }
}
