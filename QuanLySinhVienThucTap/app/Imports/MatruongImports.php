<?php

namespace App\Imports;

use App\Matruong;
use Maatwebsite\Excel\Concerns\ToModel;

class MatruongImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Matruong([
            'truong' => $row[0],
            'matruong' => $row[1],
        ]);
    }
}
