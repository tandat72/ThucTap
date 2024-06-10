<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhsachsinhvien extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mssv','tensinhvien','sodienthoai','kode_matruong','tentruongdh','email','tinhthanh','diachi'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_sinhvien';
}
