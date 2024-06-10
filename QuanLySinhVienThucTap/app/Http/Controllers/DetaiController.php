<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DetaiController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    public function index()
    {
       // Lấy danh sách sinh viên từ cơ sở dữ liệu
    $getData = DB::table('tbl_detai')
    ->select('iddetai', 'madetai', 'tendetai')->orderBy('iddetai','desc')
    ->get();


    // Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
    return view('detai.list')->with('listdetai',$getData);
    }   
    public function create()
    {
        return view('detai.create');
    } 
    public function store(Request $request)
{
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	//Lấy giá trị học sinh đã nhập
	$allRequest  = $request->all();
	$madetai  = $allRequest['madetai'];
	$tendetai  = $allRequest['tendetai'];
	$existingDetai = DB::table('tbl_detai')->where('tendetai', 'LIKE', '%' . str_replace(' ', '%', $tendetai) . '%')->first();

if ($existingDetai) {
    Toastr::error('Tên đề tài đã tồn tại!','Lỗi');
    return redirect('detai/create');
}
	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'madetai'  => $madetai,
		'tendetai'  => $tendetai,
	);
	
	//Insert vào bảng tbl_sinhvien
	$insertData = DB::table('tbl_detai')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Toastr::success('Thêm mới đề tài thành công', 'Thành công');
	}else {                        
		Toastr::error('Thêm thất bại', 'Lỗi');
	}
	
	//Thực hiện chuyển trang
	return redirect('detai');
}
public function edit($id)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('tbl_detai')->select('iddetai','madetai','tendetai')->where('iddetai', $id)->get();
	return view('detai.edit')->with('getdetaiById', $getData);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_detai')->where('iddetai', $request->id)->update([
		'madetai' => $request->madetai,
		'tendetai' => $request->tendetai,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Toastr::success( 'Sửa đề tài thành công!','Thành công');
	}else {                        
		Toastr::error('Sửa thất bại!','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('detai');
	
}
public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_detai')->where('iddetai', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Toastr::success('Xóa đề tài thành công!', 'Thành công');
	}else {                        
		Toastr::error('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('detai');
}

}
