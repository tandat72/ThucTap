<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitiet extends Model
{
    protected $table = 'tbl_chitiet';
    protected $fillable = ['idchitiet','id_test','truong','sinhvien', 'created_at', 'updated_at']; 
    
}
