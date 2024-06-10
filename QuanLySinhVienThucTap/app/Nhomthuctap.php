<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhomthuctap extends Model
{
    protected $table = 'tbl_nhomthuctap';

    protected $fillable = [
        'idnhom',
        'tennhom',
        'dotthuctap',
        'sinhvien',
        'detai',
        'cbhd',
        'donvi',
    ];
}
