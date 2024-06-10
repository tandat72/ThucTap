<?php

namespace App\Http\Controllers;

use App\Chitiet;
use App\Nhomthuctap;
use App\Sinhvienthuctap;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Truong;
use App\ChitietNhom;
use Brian2694\Toastr\Facades\Toastr;

class NhomthuctapController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    public function create()
    {  
        $detai = DB::table('tbl_detai')->get();
         $phongban = DB::table('tbl_phongban')->get();
        $dotthuctap = DB::table('tbl_thuctap')->get();
        $donvi = DB::table('tbl_donvi')->get();
        $cbhd = DB::table('tbl_cbhd')->get();
        return view('nhomthuctap.create')->with('cbhd',$cbhd)->with('dotthuctap',$dotthuctap)->with('donvi',$donvi)->with('phongban',$phongban)->with('detai',$detai);
    }
    public function index()
    {
    $getData = DB::table('tbl_chitietnhom')
    ->select('idchitietnhom','idnhom' ,'dotthuctap','sinhvien','detai', 'cbhd', 'donvi')->orderBy('idchitietnhom','desc')
    ->get();
    return view('nhomthuctap.list')->with('listnhomthuctap',$getData);
       
    }
    public function getBarang($id)
    {
        $sinhvien = Chitiet::where('id_test', $id)->get();
        return response()->json($sinhvien);
    }
    public function store(Request $request) {
        $allRequest  = $request->all();
        $idnhom  = $allRequest['idnhom'];
        $dotthuctap  = $allRequest['dotthuctap'];
        $sinhvien  = $allRequest['sinhvien'];
        $detai  = $allRequest['detai'];
        $cbhd  = $allRequest['cbhd'];
        $donvi  = $allRequest['donvi'];
        // Validate dữ liệu
        $validatedData = array(
            'idnhom'  => $idnhom,
            'dotthuctap'  => $dotthuctap,
            'sinhvien'  => $sinhvien,
            'detai'  => $detai,
            'cbhd'  => $cbhd,
            'donvi'  => $donvi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          );
        // Kiểm tra tính duy nhất của idtest
           $existingEmail = DB::table('tbl_nhomthuctap')->where('idnhom', $idnhom)->first();
           if ($existingEmail) {
               Toastr::error('Nhóm thực tập đã tồn tại!','Lỗi');
               return redirect('nhomthuctap/create');
           }
        // Lưu vào bảng tests
        $nhomthuctap = Nhomthuctap::create($validatedData); 
        $dotthuctap = $request->input('dotthuctap');
        $cbhd = $request->input('cbhd');
        $donvi = $request->input('donvi');
        $detai = $request->input('detai');
       
        // Gọi hàm xử lý chi tiết 
        $this->storeDetails($nhomthuctap->id, $validatedData['sinhvien'],$dotthuctap,$cbhd,$donvi,$detai);
         // Trả về kết quả
        //Kiểm tra Insert để trả về một thông báo
          if ($nhomthuctap) {
              Toastr::success('Thêm mới nhóm thực tập thành công!','Thành công');
          }else {                        
              Toastr::error('Thêm thất bại!','Lỗi');
          }
          
          //Thực hiện chuyển trang
          return redirect('nhomthuctap');
      }
      public function storeDetails($testId, $sinhvienString, $dotthuctap,$cbhd,$donvi,$detai) {

        $sinhvienArray = explode(',', $sinhvienString);
      
        foreach ($sinhvienArray as $sv) {
        
          $chitiet = new ChitietNhom;
          $chitiet->idnhom = $testId;
          $chitiet->dotthuctap = $dotthuctap;
          $chitiet->cbhd = $cbhd;
          $chitiet->sinhvien = $sv;
          $chitiet->detai = $detai;
          $chitiet->donvi = $donvi;
          $chitiet->save();
        
        }
      
      }
    public function destroy($id)
{
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('tbl_nhomthuctap')->where('id', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Toastr::success('Xóa nhóm thực tập thành công!','Thành công');
	}else {                        
		Toastr::error('Xóa thất bại!','Lỗi');
	}
	
	//Thực hiện chuyển trang
	return redirect('nhomthuctap');
}
public function edit($id)
{
	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
    $thuctap = DB::table('tbl_thuctap')->get();
    $chitiet = DB::table('tbl_chitiet')->get();
    $detai = DB::table('tbl_detai')->get();
	$cbhd = DB::table('tbl_cbhd')->get();
	$nhomthuctap = DB::table('tbl_chitietnhom')->select('idchitietnhom','idnhom','dotthuctap','detai','sinhvien','cbhd','donvi')->where('idchitietnhom', $id)->get();
	$donvi = DB::table('tbl_donvi')->get();
	return view('nhomthuctap.edit')->with('getnhomthuctapById', $nhomthuctap)->with('donvi', $donvi)->with('cbhd',$cbhd)->with('detai',$detai)->with('thuctap',$thuctap)->with('chitiet',$chitiet);
}
public function update(Request $request)
{
	//Cap nhat sua hoc sinh
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('tbl_chitietnhom')->where('idchitietnhom', $request->id)->update([
        'idnhom' => $request->idnhom,
		'dotthuctap' => $request->dotthuctap,
		'sinhvien' => $request->sinhvien,
		'cbhd' => $request->cbhd,
		'donvi' => $request->donvi,
		'updated_at' => date('Y-m-d H:i:s')
	]);
    
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Toastr::success('Sửa nhóm thực tập thành công!','Thành công');
	}else {                        
		Toastr::error( 'Sửa thất bại!','Lỗi');
	}
	
	//Thực hiện chuyển trang
	return redirect('nhomthuctap');
	
}
}
