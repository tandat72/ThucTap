<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Pagination\Paginator;
use Brian2694\Toastr\Facades\Toastr;
class DonviController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
{
	//Hiển thị trang thêm học sinh
	// $data = DB::table('tbl_donvi')->get();
	$phongban = DB::table('tbl_phongban')->get();
	return view('donvi.create')->with('phongban',$phongban);
}
public function store(Request $request)
{
	//Them moi hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	//Lấy giá trị học sinh đã nhập
	$allRequest  = $request->all();
	$tendonvi  = $allRequest['tendonvi'];
	$phongban  = $allRequest['phongban'];
	// Kiểm tra tính hợp lệ của mssv
    // if (strlen($mssv) !== 9) {
    //     Session::flash('error', 'MSSV phải có đúng 9 số!');
    //     return redirect('sinhvien/create');
    // }
	 // Kiểm tra họ tên có ít nhất 10 ký tự hay không
	//  if (strlen($tentruong) < 10) {
    //     Session::flash('error', 'Tên trường phải có ít nhất 10 ký tự!');
    //     return redirect('donvi/create');
    // }
	// Kiem tra sdt co hop le
	//  // Kiểm tra tính duy nhất của email
	//  $existingEmail = DB::table('tbl_sinhvien')->where('email', $email)->first();
	//  if ($existingEmail) {
	// 	 Session::flash('error', 'Email đã tồn tại!');
	// 	 return redirect('sinhvien/create');
	//  }
	 // Kiểm tra tính duy nhất của mssv
	//  $existingEmail = DB::table('tbl_sinhvien')->where('mssv', $mssv)->first();
	//  if ($existingEmail) {
	// 	 Session::flash('error', 'MSSV đã tồn tại!');
	// 	 return redirect('sinhvien/create');
	//  }
	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'tendonvi'  => $tendonvi,
		'phongban'  => $phongban,
	);
	
	//Insert vào bảng tbl_sinhvien
	$insertData = DB::table('tbl_donvi')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Toastr::success( 'Thêm mới đơn vị thành công!','Thành công');
	}else {                        
		Toastr::error('Thêm thất bại!','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('donvi');
}
public function index(Request $request)
{
	

 // Lấy danh sách sinh viên từ cơ sở dữ liệu
 $getData = DB::table('tbl_donvi')
 ->select('id',  'tendonvi','phongban')->orderBy('id','desc')
 ->get();


// Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
return view('donvi.list')->with('listdonvi',$getData);
}

public function edit($id)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('tbl_donvi')->select('id',  'tendonvi','phongban')->where('id', $id)->get();
	$data = DB::table('tbl_truong')->get();
	$phongban = DB::table('tbl_phongban')->get();
	return view('donvi.edit')->with('getdonviById', $getData)->with('data', $data)->with('phongban',$phongban);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_donvi')->where('id', $request->id)->update([
		'tendonvi' => $request->tendonvi,
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Toastr::success('Sửa đơn vị thành công!','Thành công');
	}else {                        
		Toastr::error('Sửa thất bại!','Lỗi');
	}
	
	//Thực hiện chuyển trang
	return redirect('donvi');
	
}

public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_donvi')->where('id', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Toastr::success('Xóa đơn vị thành công!','Thành công');
	}else {                        
		Toastr::error( 'Xóa thất bại!','Lỗi');
	}
	
	//Thực hiện chuyển trang
	return redirect('donvi');
}

}
