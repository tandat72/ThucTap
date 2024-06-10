<?php

namespace App\Imports;

use App\Danhsachdotthuctap;
use Maatwebsite\Excel\Concerns\ToModel;

class DotthuctapImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Danhsachdotthuctap([
            'truong' => $row[0],
            'matruong' => $row[1],
            'sinhvien' => $row[2],
            'tgbd' => $row[3],
            'tgkt' => $row[4],
        ]);
    }
}
