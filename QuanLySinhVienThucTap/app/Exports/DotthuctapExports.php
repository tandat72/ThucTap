<?php

namespace App\Exports;

use App\Danhsachdotthuctap;
use Maatwebsite\Excel\Concerns\FromCollection;

class DotthuctapExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Danhsachdotthuctap::all();
    }
}
