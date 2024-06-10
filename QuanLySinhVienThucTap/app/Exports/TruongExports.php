<?php

namespace App\Exports;

use App\Danhsachtruong;
use Maatwebsite\Excel\Concerns\FromCollection;

class TruongExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Danhsachtruong::all();
    }
}
