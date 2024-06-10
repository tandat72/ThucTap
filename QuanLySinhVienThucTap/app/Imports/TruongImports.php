<?php

namespace App\Imports;

use App\Danhsachtruong;
use Maatwebsite\Excel\Concerns\ToModel;

class TruongImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Danhsachtruong([
            'matruong' => $row[0],
            'tentruong' => $row[1],
        ]);
    }
}
