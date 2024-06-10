<?php

namespace App\Imports;

use App\Danhsachsinhvien;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Danhsachsinhvien([
            'mssv' => $row[0],
            'tensinhvien' => $row[1],
            'sodienthoai' => $row[2],
            'kode_matruong' => $row[3],
            'tentruongdh' => $row[4],
            'email' => $row[5],
            'tinhthanh' => $row[6],
            'diachi' => $row[7],
        ]);
    }
}
