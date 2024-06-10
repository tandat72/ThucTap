<?php

namespace App\Http\Controllers;

use App\Exports\TruongExports;
use App\Imports\TruongImports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
class TruongController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
{
	//Hiển thị trang thêm học sinh
	$data = DB::table('tbl_truong')->get();
	return view('truong.create',compact('data'));
}
public function store(Request $request)
{
	//Them moi hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	//Lấy giá trị học sinh đã nhập
	$allRequest  = $request->all();
	$matruong  = $allRequest['matruong'];
	$tentruong  = $allRequest['tentruong'];
	// Kiểm tra tính hợp lệ của mssv
    // if (strlen($mssv) !== 9) {
    //     Session::flash('error', 'MSSV phải có đúng 9 số!');
    //     return redirect('sinhvien/create');
    // }
	 // Kiểm tra họ tên có ít nhất 10 ký tự hay không
	 if (strlen($tentruong) < 10) {
        Session::flash('error', 'Tên trường phải có ít nhất 10 ký tự!');
        return redirect('tentruong/create');
    }
	$existingTruong = DB::table('tbl_truong')->where('tentruong', 'LIKE', '%' . str_replace(' ', '%', $tentruong) . '%')->first();

if ($existingTruong) {
    Session::flash('error', 'Tên trường đã tồn tại!');
    return redirect('truong/create');
}
	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'matruong'  => $matruong,
		'tentruong'  => $tentruong,
	);
	
	//Insert vào bảng tbl_sinhvien
	$insertData = DB::table('tbl_truong')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Session::flash('success', 'Thêm mới trường thành công!');
	}else {                        
		Session::flash('error', 'Email đã tồn tại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('truong');
}
public function index(Request $request)
{
	

 // Lấy danh sách sinh viên từ cơ sở dữ liệu
 $getData = DB::table('tbl_truong')
 ->select('idtruong', 'matruong', 'tentruong')->orderBy('idtruong','desc')
 ->get();


// Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
return view('truong.list')->with('listtruong',$getData);
}

public function edit($idtruong)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('tbl_truong')->select('idtruong',  'matruong','tentruong')->where('idtruong', $idtruong)->get();
	$data = DB::table('tbl_truong')->get();
	return view('truong.edit')->with('gettruongById', $getData)->with('data', $data);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_truong')->where('idtruong', $request->idtruong)->update([
		'matruong' => $request->matruong,
		'tentruong' => $request->tentruong,
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Session::flash('success', 'Sửa trường thành công!');
	}else {                        
		Session::flash('error', 'Sửa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('truong');
	
}

public function destroy($idtruong)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_truong')->where('idtruong', '=', $idtruong)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Session::flash('success', 'Xóa trường thành công!');
	}else {                        
		Session::flash('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('truong');
}
public function export_csv3()
{
	return Excel::download(new TruongExports , 'danhsachtruong.xlsx');
}
public function import_csv3(Request $request)
{
	$path = $request->file('file')->getRealPath();
	Excel::import(new TruongImports, $path);
	return back();
}
}
