@extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title','Quản lý đợt thực tập')
@section('active3')
active
@endsection

@section('content')
<div class="page-header"><h4>Quản lý đợt thực tập</h4></div>
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
	  <div class="inner">
		<p>Thêm mới đợt thực tập</p>
	  </div>
	  <div class="icon">
		<i class="ion ion-person-add"></i>
	  </div>
	  <a href="{{ url('thuctap/create')}}" class="small-box-footer">Thêm <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<form action="{{url('import-csv4')}}" method="POST" enctype="multipart/form-data">
	@csrf
  <input type="file" name="file" accept=".xlsx"><br>
 <input type="submit" value="Nhập dữ liệu Excel" name="import_csv4" class="btn btn-warning">
  </form>
 <form action="{{url('export-csv4')}}" method="POST">
	@csrf
 <input type="submit" value="Xuất dữ liệu Danh sách đợt thực tập" name="export_csv4" class="btn btn-success">
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
				<th>Đợt thực tập</th>
			
				<th>Trường</th>
                <th>Sinh viên</th>
				<th>Xem chi tiết</th>
				<th>Sửa</th>
				<th>Xóa</th>
            </tr>
        </thead>
        <tbody>
			@php
			$stt = 1;
			@endphp
			@foreach($listthuctap as $thuctap)
				<tr>
					<td>{{ $stt++ }}</td>
					<td>{{ $thuctap->id_test }}</td>
					
					<td>{{ $thuctap->truong }}</td>
					<td>{{ $thuctap->sinhvien }}</td>
					
					<td>
						<button type="button" style="font-size:12px;" class="btn btn-info btn-lg btn-modal" data-toggle="modal" data-target="#myModal" data-id_test="{{ $thuctap->id_test }} "data-madotthuctap="{{ $thuctap->madotthuctap }}"data-truong="{{ $thuctap->truong }}"data-sinhvien="{{ $thuctap->sinhvien }}"data-tgbd="{{ $thuctap->tgbd }}"data-tgkt="{{ $thuctap->tgkt }}">Xem chi tiết</button>					
					</td>
					<td>
						<a class="btn btn-primary" style="padding: 25%;" href="/thuctap/{{ $thuctap->idchitiet }}/edit">
							<i class="far fa-edit"></i>
						</a>
					</td>
					<td>
						<a class="btn btn-primary" style="padding: 25%;" href="/thuctap/{{ $thuctap->idchitiet }}/delete" onclick="return confirmDelete()">
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
                    <label>Đợt thực tập</label>
                    <input type="id" class="form-control" id="id_test" readonly />
                </div>
                <div class="form-group">
                    <label>Mã đợt thực tập</label>
                    <input type="text" class="form-control" id="madotthuctap" readonly />
                </div>
				
				<div class="form-group">
                    <label>Trường</label>
                    <input type="text" class="form-control" id="truong" readonly />
                </div>
				<div class="form-group">
                    <label>Sinh viên</label>
                    <input type="text" class="form-control" id="sinhvien"  readonly />
                </div>
				<div class="form-group">
                    <label>Thời gian bắt đầu</label>
                    <input type="date" class="form-control" id="tgbd" readonly />
                </div>
				<div class="form-group">
                    <label>Thời gian kết thúc</label>
                    <input type="date" class="form-control" id="tgkt" readonly />
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
    // Hàm để hiển thị thông tin của thành viên trong modal
    function showMemberDetails(id_test, madotthuctap,truong,sinhvien,tgbd,tgkt) {
        // Điền thông tin vào các trường dữ liệu trong modal
        document.getElementById('id_test').value = id_test;
        document.getElementById('madotthuctap').value = madotthuctap;
		document.getElementById('truong').value = truong;
		document.getElementById('sinhvien').value = sinhvien;
		document.getElementById('tgbd').value = tgbd;
		document.getElementById('tgkt').value = tgkt;

        // Các trường dữ liệu khác tương tự
        // Hiển thị modal
        $('#myModal').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        // Gọi hàm showMemberDetails khi nhấn vào nút "Xem chi tiết"
        $('.btn-modal').click(function() {
            var id_test = $(this).data('id_test');
            var madotthuctap = $(this).data('madotthuctap');
			var truong = $(this).data('truong');
			var sinhvien = $(this).data('sinhvien');
			var tgbd = $(this).data('tgbd');
			var tgkt = $(this).data('tgkt');
			var tinhthanh = $(this).data('tinhthanh');
			var diachi = $(this).data('diachi');

            // Các trường dữ liệu khác tương tự
            showMemberDetails(id_test, madotthuctap,truong,sinhvien,tgbd,tgkt);
        });
    });
</script>
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
@endsection
</html>