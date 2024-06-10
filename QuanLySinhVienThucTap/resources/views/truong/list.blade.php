@extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title','Quản lý trường')
@section('active4')
active
@endsection
@section('content')
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
	  <div class="inner">
		<p>Thêm mới trường</p>
	  </div>
	  <div class="icon">
		<i class="ion ion-person-add"></i>
	  </div>
	  <a href="{{ url('truong/create')}}" class="small-box-footer">Thêm <i class="fas fa-arrow-circle-right"></i></a>
	</div>
  </div>
  <form action="{{url('import-csv3')}}" method="POST" enctype="multipart/form-data">
	@csrf
  <input type="file" name="file" accept=".xlsx"><br>
 <input type="submit" value="Nhập dữ liệu Excel" name="import_csv3" class="btn btn-warning">
  </form>
 <form action="{{url('export-csv3')}}" method="POST">
	@csrf
 <input type="submit" value="Xuất dữ liệu danh sách trường" name="export_csv3" class="btn btn-success">
</form>
  <?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Quản lý trường</h4></div>

@if ( Session::has('success') )
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>{{ Session::get('success') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif

<?php //Hiển thị thông báo lỗi?>
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
				<th>Mã trường</th>
                <th>Tên trường</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
			@php
			// $stt = ($listsinhvien->currentPage() - 1) * $listsinhvien->perPage() + 1;
			$stt = 1
	 @endphp
	 @foreach($listtruong as $truong)
		 <tr>
			 <?php //Điền số thứ tự?>
			 <td>{{ $stt++ }}</td>
			 <?php //Lấy tên sinh viên?>
			 <td>{{ $truong->matruong }}</td>
			 <?php //Lấy tên sinh viên?>
			 <td>{{ $truong->tentruong }}</td>
			 <?php //Tạo nút sửa sinh viên?>
			 <td><a class="btn btn-primary" style="padding: 10%;" href="/truong/{{ $truong->idtruong }}/edit"><i class="far fa-edit"></i></a></td>
			 <?php //Tạo nút xóa sinh viên?>
			 <td><a class="btn btn-primary" style="padding: 10%;" href="/truong/{{ $truong->idtruong }}/delete" onclick="return confirmDelete()"><i class="fas fa-trash-alt"></i></a></td>
		 </tr>
	 <?php //Kết thúc vòng lập foreach?>
	 @endforeach
        </tbody>
    
    </table>
</body>

<script>
	new DataTable('#example');
</script>
<script>
	function confirmDelete() {
   return confirm("Bạn có chắc chắn muốn xóa không?");
}
</script>

<style>
	.form-control{
		max-width: 300px;
	}
</style>
@endsection
</html>
