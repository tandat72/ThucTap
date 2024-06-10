<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhsachdotthuctap extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'truong','matruong','sinhvien','tgbd','tgkt'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_thuctap';
}
