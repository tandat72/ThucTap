<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\MatruongImports;
use App\Exports\MatruongExport;
class MatruongController extends Controller
{
    public function index()
    {
         // Lấy danh sách sinh viên từ cơ sở dữ liệu
 $getData = DB::table('tbl_matruong')
 ->select('id', 'truong', 'matruong')
 ->get();


// Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
return view('matruong.list')->with('listmatruong',$getData);
    }
    public function export_csv2()
{
	return Excel::download(new MatruongExport , 'dsmatuong.xlsx');
}
public function import_csv2(Request $request)
{
	$path = $request->file('file')->getRealPath();
	Excel::import(new MatruongImports, $path);
	return back();
}
}
