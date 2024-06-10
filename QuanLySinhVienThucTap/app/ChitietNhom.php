<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChitietNhom extends Model
{
    protected $table = 'tbl_chitietnhom';
    protected $fillable = ['idchitietnhom','idnhom','dotthuctap','sinhvien','detai','cbhd', 'donvi','created_at', 'updated_at']; 
}
