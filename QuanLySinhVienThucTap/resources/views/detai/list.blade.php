@extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title','Quản lý đề tài')
@section('active8')
active
@endsection
@section('content')
<div class="page-header"><h4>Quản lý đề tài</h4></div>
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
	  <div class="inner">
		<p>Quản lý đề tài</p>
	  </div>
	  <div class="icon">
		<i class="ion ion-person-add"></i>
	  </div>
	  <a href="{{ url('detai/create')}}" class="small-box-footer">Thêm <i class="fas fa-arrow-circle-right"></i></a>
	</div>
  </div>
  {{-- <form action="{{url('import-csv5')}}" method="POST" enctype="multipart/form-data">
	@csrf
  <input type="file" name="file" accept=".xlsx"><br>
 <input type="submit" value="Nhập dữ liệu Excel" name="import_csv5" class="btn btn-warning">
  </form>
 <form action="{{url('export-csv5')}}" method="POST">
	@csrf
 <input type="submit" value="Xuất dữ liệu danh sách trường" name="export_csv5" class="btn btn-success">
</form> --}}
  <?php //Hiển thị thông báo thành công?>


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
				<th>Mã đề tài</th>
                <th>Tên đề tài</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
			@php
			// $stt = ($listsinhvien->currentPage() - 1) * $listsinhvien->perPage() + 1;
			$stt = 1
	 @endphp
	 @foreach($listdetai as $detai)
		 <tr>
			 <?php //Điền số thứ tự?>
			 <td>{{ $stt++ }}</td>
			 <?php //Lấy tên sinh viên?>
			 <td>{{ $detai->madetai }}</td>
			 <?php //Lấy tên sinh viên?>
			 <td>{{ $detai->tendetai }}</td>
			 <?php //Tạo nút sửa sinh viên?>
			 <td><a class="btn btn-primary" style="padding: 10%;" href="/detai/{{ $detai->iddetai }}/edit"><i class="far fa-edit"></i></a></td>
			 <?php //Tạo nút xóa sinh viên?>
			 <td><a class="btn btn-primary" style="padding: 10%;" href="/detai/{{ $detai->iddetai }}/delete" onclick="return confirmDelete()"><i class="fas fa-trash-alt"></i></a></td>
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
