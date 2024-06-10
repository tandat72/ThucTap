@extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title','Quản lý sinh viên')
@section('active')
active
@endsection

@section('content')
<div class="page-header"><h4>Quản lý sinh viên</h4></div>
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
	  <div class="inner">
		<p>Thêm mới sinh viên</p>
	  </div>
	  <div class="icon">
		<i class="ion ion-person-add"></i>
	  </div>
	  <a href="{{ url('sinhvien/create')}}" class="small-box-footer">Thêm <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-lg-3 col-6">
<form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
	@csrf
  <input type="file" name="file" accept=".xlsx"><br>
 <input type="submit" value="Nhập dữ liệu Excel" name="import_csv" class="btn btn-warning">
  </form>
 <form action="{{url('export-csv')}}" method="POST">
	@csrf
 <input type="submit" value="Xuất dữ liệu DSSV" name="export_csv" class="btn btn-success">
</form>
</div>
@if ( Session::has('success') )
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>{{ Session::get('success') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

@if ( Session::has('error') )
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong>{{ Session::get('error') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
	<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
	<title>test</title>
</head>
<body>
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
				<th>STT</th>
                <th>Mssv</th>
                <th>Tên</th>
                <th>Trường</th>
				<th>Mã trường</th>
				<th>Xem chi tiết</th>
				<th>Sửa</th>
				<th>Xóa</th>
            </tr>
        </thead>
        <tbody>
			@php
			$stt = 1;
			@endphp
			@foreach($listsinhvien as $sinhvien)
				<tr>
					<td>{{ $stt++ }}</td>
					<td>{{ $sinhvien->mssv }}</td>
					<td>{{ $sinhvien->tensinhvien }}</td>
					<td>{{ $sinhvien->tentruongdh }}</td>
					<td>{{ $sinhvien->kode_matruong }}</td>
					<td>
						<button type="button" style="font-size:12px;" class="btn btn-info btn-lg btn-modal" data-toggle="modal" data-target="#myModal" data-mssv="{{ $sinhvien->mssv }}" data-tensinhvien="{{ $sinhvien->tensinhvien }} "data-sodienthoai="{{ $sinhvien->sodienthoai }}"data-tentruongdh="{{ $sinhvien->tentruongdh }}"data-kode_matruong="{{ $sinhvien->kode_matruong }}"data-email="{{ $sinhvien->email }}"data-tinhthanh="{{ $sinhvien->tinhthanh }}"data-diachi="{{ $sinhvien->diachi }}" >Xem chi tiết</button>					
					</td>
					<td>
						<a class="btn btn-primary" style="padding: 25%;" href="/sinhvien/{{ $sinhvien->id }}/edit">
							<i class="far fa-edit"></i>
						</a>
					</td>
					<td>
						<a class="btn btn-primary" style="padding: 25%;" href="/sinhvien/{{ $sinhvien->id }}/delete" onclick="confirmDelete(event)">
							<i class="fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
			@endforeach
        </tbody>
       
    </table>
</body>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
  
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Chi tiết sinh viên</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">	
			<div class="modal-body">
                <div class="form-group">
                    <label>MSSV</label>
                    <input type="text" class="form-control" id="mssv" readonly />
                </div>
                <div class="form-group">
                    <label>Tên sinh viên</label>
                    <input type="text" class="form-control" id="tensinhvien" readonly />
                </div>
				
				<div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" id="sodienthoai" readonly />
                </div>
				<div class="form-group">
                    <label>Trường đại học</label>
                    <input type="text" class="form-control" id="tentruongdh"  readonly />
                </div>
				<div class="form-group">
                    <label>Mã trường</label>
                    <input type="text" class="form-control" id="kode_matruong" readonly />
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email" readonly />
                </div>
				<div class="form-group">
                    <label>Tỉnh thành</label>
                    <input type="text" class="form-control" id="tinhthanh" readonly />
                </div>
				<div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" id="diachi" readonly />
                </div>
                <!-- Các trường dữ liệu khác -->
            </div>
				
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
  
	</div>
  </div>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>

<script>
	function confirmDelete() {
   return confirm("Bạn có chắc chắn muốn xóa không?");
}
</script>
<style>
	.form-control {
		max-width: 300px;
	}
	
</style>
<script>
    // Hàm để hiển thị thông tin của thành viên trong modal
    function showMemberDetails(mssv, tensinhvien,sodienthoai,tentruongdh,kode_matruong,email,tinhthanh, diachi) {
        // Điền thông tin vào các trường dữ liệu trong modal
        document.getElementById('mssv').value = mssv;
        document.getElementById('tensinhvien').value = tensinhvien;
		document.getElementById('sodienthoai').value = sodienthoai;
		document.getElementById('tentruongdh').value = tentruongdh;
		document.getElementById('kode_matruong').value = kode_matruong;
		document.getElementById('email').value = email;
		document.getElementById('tinhthanh').value = tinhthanh;
		document.getElementById('diachi').value = diachi;

        // Các trường dữ liệu khác tương tự
        // Hiển thị modal
        $('#myModal').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        // Gọi hàm showMemberDetails khi nhấn vào nút "Xem chi tiết"
        $('.btn-modal').click(function() {
            var mssv = $(this).data('mssv');
            var tensinhvien = $(this).data('tensinhvien');
			var sodienthoai = $(this).data('sodienthoai');
			var tentruongdh = $(this).data('tentruongdh');
			var kode_matruong = $(this).data('kode_matruong');
			var email = $(this).data('email');
			var tinhthanh = $(this).data('tinhthanh');
			var diachi = $(this).data('diachi');

            // Các trường dữ liệu khác tương tự
            showMemberDetails(mssv, tensinhvien,sodienthoai,tentruongdh,kode_matruong,email,tinhthanh, diachi);
        });
    });
</script>
@endsection
</html>