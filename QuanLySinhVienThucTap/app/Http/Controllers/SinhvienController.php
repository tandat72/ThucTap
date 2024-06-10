<?php

namespace App\Http\Controllers;
use App\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Pagination\Paginator;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Maatwebsite\Excel\Facades\Excel;
use Brian2694\Toastr\Facades\Toastr;
class SinhvienController extends Controller
{
	public function show($id)
    {
        $sinhvien = Sinhvien::find($id);
        return response()->json($sinhvien);
    }
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
{
	//Hiển thị trang thêm học sinh
	$tinhthanh = DB::table('tbl_diachi')->get();
	$data = DB::table('tbl_truong')->get();
	return view('sinhvien.create',compact('data','tinhthanh'));
}

public function store(Request $request)
{	
	//Them moi hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	
	//Lấy giá trị học sinh đã nhập
	$allRequest  = $request->all();
	$mssv  = $allRequest['mssv'];
	$tensinhvien  = $allRequest['tensinhvien'];
	$sodienthoai = $allRequest['sodienthoai'];
	$email  = $allRequest['email'];
	$diachi  = $allRequest['diachi'];
	$kode_matruong  = $allRequest['kode_matruong'];
	$tentruongdh = $allRequest['tentruongdh'];
	$tinhthanh = $allRequest['tinhthanh'];
	$truongArray = explode(", ", $tentruongdh);

	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'mssv'  => $mssv,
		'tensinhvien'  => $tensinhvien,
		'sodienthoai' => $sodienthoai,
		'kode_matruong' => $kode_matruong,
		'tentruongdh' => $tentruongdh,
		'email'  => $email,
		'tinhthanh' => $tinhthanh,
		'diachi' => $diachi,
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
	);
	
	//Insert vào bảng tbl_sinhvien
	$insertData = DB::table('tbl_sinhvien')->insert($dataInsertToDatabase);
	
	//Kiểm tra Insert để trả về một thông báo
	if ($insertData) {
		Toastr::success('Thêm sinh viên thành công', 'Thành công');
	}else {                        
		Toastr::error('Thêm thất bại','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('sinhvien');
}
public function index(Request $request)
{
	

 // Lấy danh sách sinh viên từ cơ sở dữ liệu
 $getData = DB::table('tbl_sinhvien')
 ->select('id', 'mssv', 'tensinhvien', 'sodienthoai', 'kode_matruong','tentruongdh', 'email','tinhthanh', 'diachi')->orderBy('id','desc')
 ->get();


// Gọi đến file list.blade.php trong thư mục "resources/views/sinhvien" với giá trị gửi đi tên listsinhvien = $listsinhvien và data = $data
return view('sinhvien.list')->with('listsinhvien',$getData);
}

public function edit($id)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$tinhthanh = DB::table('tbl_diachi')->get();
	$getData = DB::table('tbl_sinhvien')->select('id','mssv','tensinhvien','sodienthoai','kode_matruong','tentruongdh','email','tinhthanh','diachi')->where('id', $id)->get();
	$data = DB::table('tbl_truong')->get();
	return view('sinhvien.edit')->with('getsinhvienById', $getData)->with('data', $data)->with('tinhthanh',$tinhthanh);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_sinhvien')->where('id', $request->id)->update([
		'mssv' => $request->mssv,
		'tensinhvien' => $request->tensinhvien,
		'sodienthoai' => $request->sodienthoai,
		'kode_matruong' => $request->kode_matruong,
		'tentruongdh' => $request->tentruongdh,
		'email' => $request->email,
		'tinhthanh' => $request->tinhthanh,
		'diachi' => $request->diachi,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Session::flash('success', 'Sửa sinh viên thành công!');
	}else {                        
		Session::flash('error', 'Sửa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('sinhvien');
	
}

public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_sinhvien')->where('id', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Toastr::success( 'Xóa sinh viên thành công!','Thành công');
	}else {                        
		Toastr::error('Xóa thất bại!','Thất bại');
	}
	
	//Thực hiện chuyển trang
	return redirect('sinhvien');
}
public function export_csv()
{
	return Excel::download(new ExcelExports , 'danhsachsinhvien.xlsx');
}
public function import_csv(Request $request)
{
	$path = $request->file('file')->getRealPath();
	Excel::import(new ExcelImports, $path);
	return back();
}
}
