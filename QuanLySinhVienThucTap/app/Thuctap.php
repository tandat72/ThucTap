<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thuctap extends Model
{
    protected $table = 'tbl_thuctap';

    protected $fillable = [
        'idthuctap',
        'madotthuctap',
        'truong',
        'sinhvien',
        'tgbd',
        'tgkt',
    ];
}