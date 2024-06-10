<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matruong extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'truong','matruong'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_matruong';
}
