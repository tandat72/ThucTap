<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Pagination\Paginator;
use Brian2694\Toastr\Facades\Toastr;
class CanbohuongdanController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
{
	//Hiển thị trang thêm học sinh
	$donvi = DB::table('tbl_donvi')->get();
	$phongban = DB::table('tbl_phongban')->get();
	return view('cbhd.create')->with('donvi',$donvi)->with('phongban',$phongban);
}
public function store(Request $request)
{
	//Them moi hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	//Lấy giá trị học sinh đã nhập
	$allRequest  = $request->all();
	$macbhd  = $allRequest['macbhd'];
	$tencanbo  = $allRequest['tencanbo'];
	$tendonvi  = $allRequest['tendonvi'];
	$phongban  = $allRequest['phongban'];
	// Kiểm tra tính hợp lệ của mssv
    // if (strlen($mssv) !== 9) {
    //     Session::flash('error', 'MSSV phải có đúng 9 số!');
    //     return redirect('sinhvien/create');
    // }
	 // Kiểm tra họ tên có ít nhất 10 ký tự hay không
	 if (strlen($tencanbo) < 2) {
        Session::flash('error', 'Họ và tên phải có ít nhất 2 ký tự!');
        return redirect('cbhd/create');
    }
	// Kiem tra sdt co hop le
	// if (strlen($sodienthoai) < 10 || strlen($sodienthoai) > 11 || substr($sodienthoai, 0, 1) !== '0') {
	// 	Session::flash('error', 'Số điện thoại bắt đầu từ 0 và 10 hoặc 11 số!');
	// 	return redirect('sinhvien/create');
	// }
	 // Kiểm tra tính duy nhất của email
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
		'macbhd'  => $macbhd,
		'tencanbo'  => $tencanbo,
		'tendonvi' => $tendonvi,
		'phongban' => $phongban,
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
	);
	
	//Insert vào bảng tbl_sinhvien
	$insertData = DB::table('tbl_cbhd')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Toastr::success( 'Thêm mới cán bộ thành công!','Thành công');
	}else {                        
		Toastr::error('Sửa cán bộ hướng dẫn thất bại','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('cbhd');
}
public function index(Request $request)
{
	

 // Lấy danh sách sinh viên từ cơ sở dữ liệu
 $getData = DB::table('tbl_cbhd')
 ->select('id', 'macbhd', 'tencanbo', 'tendonvi','phongban')->orderBy('id','desc')
 ->get();


// Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
return view('cbhd.list')->with('listcbhd',$getData);
}

public function edit($id)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('tbl_cbhd')->select('id','macbhd','tencanbo','tendonvi','phongban')->where('id', $id)->get();
	$donvi = DB::table('tbl_donvi')->get();
	$phongban = DB::table('tbl_phongban')->get();
	return view('cbhd.edit')->with('getcbhdById', $getData)->with('donvi', $donvi)->with('phongban',$phongban);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_cbhd')->where('id', $request->id)->update([
		'macbhd' => $request->macbhd,
		'tencanbo' => $request->tencanbo,
		'tendonvi' => $request->tendonvi,
		'phongban' => $request->phongban,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Toastr::success( 'Sửa cán bộ thành công!','Thành công');
	}else {                        
		Toastr::error('Sửa thất bại!','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('cbhd');
	
}

public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_cbhd')->where('id', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Toastr::success('Xóa cán bộ thành công!', 'Thành công');
	}else {                        
		Toastr::error('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('cbhd');
}

}
