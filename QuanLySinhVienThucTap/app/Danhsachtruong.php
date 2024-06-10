<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhsachtruong extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'matruong','tentruong'
    ];
    protected $primaryKey = 'idtruong';
    protected $table = 'tbl_truong';
}
