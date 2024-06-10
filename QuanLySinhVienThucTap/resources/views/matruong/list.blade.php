@extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title','Danh sách mã trường')
@section('active7')
active
@endsection

@section('content')
<div class="page-header"><h4>Danh sách mã trường</h4></div>

<form action="{{url('import-csv2')}}" method="POST" enctype="multipart/form-data">
	@csrf
  <input type="file" name="file" accept=".xlsx"><br>
 <input type="submit" value="Nhập dữ liệu Excel" name="import_csv2" class="btn btn-warning">
  </form>
 <form action="{{url('export-csv2')}}" method="POST">
	@csrf
 <input type="submit" value="Xuất dữ liệu DSSV" name="export_csv2" class="btn btn-success">
</form>
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
                <th>Trường</th>
                <th>Mã trường</th>
				
            </tr>
        </thead>
        <tbody>
			@php
			$stt = 1;
			@endphp
			@foreach($listmatruong as $matruong)
				<tr>
					<td>{{ $stt++ }}</td>
					<td>{{ $matruong->truong }}</td>
					<td>{{ $matruong->matruong }}</td>
				</tr>
			@endforeach
        </tbody>
       
    </table>
</body>

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
    function showMemberDetails(truong, matruong) {
        // Điền thông tin vào các trường dữ liệu trong modal
        document.getElementById('truong').value = truong;
        document.getElementById('matruong').value = matruong;

        // Các trường dữ liệu khác tương tự
        // Hiển thị modal
        $('#myModal').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        // Gọi hàm showMemberDetails khi nhấn vào nút "Xem chi tiết"
        $('.btn-modal').click(function() {
            var truong = $(this).data('truong');
			var matruong = $(this).data('matruong');
            // Các trường dữ liệu khác tương tự
            showMemberDetails(truong, matruong);
        });
    });
</script>
@endsection
</html>