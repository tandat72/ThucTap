<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Kategori;
use App\Barang;
use App\Exports\DotthuctapExports;
use App\Imports\DotthuctapImports;
use App\Sinhvien;
use App\Thuctap;
use App\Chitiet;
use App\Truong;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ThuctapController extends Controller
{
    public function index()
    {
    $getData = DB::table('tbl_chitiet')
        ->select('idchitiet', 'id_test','madotthuctap','truong', 'sinhvien','tgbd','tgkt')->orderBy('idchitiet','desc')
        ->get();
	return view('thuctap.list')->with('listthuctap',$getData);
    }
    public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
    {
		$truong = DB::table('tbl_truong')->get();
		$sinhvien = DB::table('tbl_sinhvien')->get();
		return view('thuctap.create')->with('truong',$truong)->with('sinhvien',$sinhvien);
    }

    public function getBarang($id)
    {
        $sinhvien = Sinhvien::where('tentruongdh', $id)->get();
        return response()->json($sinhvien);
    }

   
	public function store(Request $request) {
        $allRequest  = $request->all();
        $idthuctap  = $allRequest['idthuctap'];
        $madotthuctap  = $allRequest['madotthuctap'];
        $truong  = $allRequest['truong'];
        $sinhvien  = $allRequest['sinhvien'];
        $tgbd  = $allRequest['tgbd'];
        $tgkt  = $allRequest['tgkt'];
        // Validate dữ liệu
        $validatedData = array(
            'idthuctap'  => $idthuctap,
            'madotthuctap'  => $madotthuctap,
            'truong'  => $truong,
            'sinhvien'  => $sinhvien,
            'tgbd'  => $tgbd,
            'tgkt'  => $tgkt,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          );
        // Kiểm tra tính duy nhất của idtest
           $existingEmail = DB::table('tbl_thuctap')->where('idthuctap', $idthuctap)->first();
           if ($existingEmail) {
               Session::flash('error', 'Đợt thực tập đã tồn tại!');
               return redirect('thuctap/create');
           }
        // Lưu vào bảng tests
        $test = Thuctap::create($validatedData); 
        $truong = $request->input('truong');
        $madotthuctap = $request->input('madotthuctap');
        $tgbd = $request->input('tgbd');
        $tgkt = $request->input('tgkt');
        // Gọi hàm xử lý chi tiết 
        $this->storeDetails($test->id, $validatedData['sinhvien'],$madotthuctap,$truong,$tgbd,$tgkt);
         // Trả về kết quả
        //Kiểm tra Insert để trả về một thông báo
          if ($test) {
              Toastr::success('Thêm mới đợt thực tập thành công!','Thành công');
          }else {                        
              Toastr::error('Thêm thất bại!','Thất bại');
          }
          
          //Thực hiện chuyển trang
          return redirect('thuctap');
      }
      
public function storeDetails($testId, $sinhvienString, $madotthuctap,$truong,$tgbd,$tgkt) {

    $sinhvienArray = explode(',', $sinhvienString);
  
    foreach ($sinhvienArray as $sv) {
    
      $chitiet = new Chitiet;
      $chitiet->id_test = $testId;
      $chitiet->madotthuctap = $madotthuctap;
      $chitiet->truong = $truong;
      $chitiet->sinhvien = $sv;
      $chitiet->tgbd = $tgbd;
      $chitiet->tgkt = $tgkt;
      $chitiet->save();
    
    }
  
  }
    public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_chitiet')->where('idchitiet', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Session::flash('success', 'Xóa sinh viên thành công!');
	}else {                        
		Session::flash('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('thuctap');
}
public function edit($id)
{   
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('tbl_chitiet')->select('idchitiet','id_test','madotthuctap','truong','sinhvien','tgbd','tgkt')->where('idchitiet', $id)->get();
	$truong = DB::table('tbl_truong')->get();
    $sinhvien = DB::table('tbl_sinhvien')->get();
	return view('thuctap.edit')->with('getthuctapById', $getData)->with('truong', $truong)->with('sinhvien',$sinhvien);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_chitiet')->where('idchitiet', $request->id)->update([
        'id_test' => $request->id_test,
        'madotthuctap' => $request->id_test,
		'truong' => $request->truong,
		'sinhvien' => $request->sinhvien,
		'tgbd' => $request->tgbd,
        'tgkt' => $request->tgkt,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Session::flash('success', 'Sửa đợt thực tập thành công!');
	}else {                        
		Session::flash('error', 'Sửa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('thuctap');
	
}
public function export_csv4()
{
	return Excel::download(new DotthuctapExports , 'Danh sách đợt thực tập.xlsx');
}
public function import_csv4(Request $request)
{
	$path = $request->file('file')->getRealPath();
	Excel::import(new DotthuctapImports, $path);
	return back();
}
}