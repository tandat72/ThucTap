<?php

namespace App\Exports;

use App\Matruong;
use Maatwebsite\Excel\Concerns\FromCollection;

class MatruongExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Matruong::all();
    }
}
