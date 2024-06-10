@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý sinh viên')
@section('active')
active
@endsection
@section('content')

{{-- <div class="page-header"><h4>Quản lý sinh viên</h4></div> --}}

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

<?php //Hiển thị form sửa học sinh?>
{{-- <p><a class="btn btn-primary" href="{{ url('/sinhvien') }}">Về danh sách</a></p> --}}
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Sửa sinh viên</h4></center>
	<form action="{{ url('/sinhvien/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getsinhvienById[0]->id !!}" />
		<div class="form-group">
			<label for="id">ID</label>
			<input type="text" class="form-control" id="id" name="id" placeholder="stt" maxlength="11" value="{{ $getsinhvienById[0]->id }}" readonly required />
		</div>
		<div class="form-group">
			<label for="mssv">Mssv</label>
			<input type="text" class="form-control" id="mssv" name="mssv" placeholder="Mã số sinh viên" maxlength="11" value="{{ $getsinhvienById[0]->mssv }}"  required />
		</div>
		<div class="form-group">
			<label for="tensinhvien">Tên sinh viên</label>
			<input type="text" class="form-control" id="tensinhvien" name="tensinhvien" placeholder="Tên học sinh" maxlength="255" value="{{ $getsinhvienById[0]->tensinhvien }}" required />
		</div>
		<div class="form-group">
			<label for="sodienthoai">Số điện thoại</label>
			<input type="text" class="form-control" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại" maxlength="15" value="{{ $getsinhvienById[0]->sodienthoai }}" required />
		</div>
		
		<div class="form-group">
			<label for="tentruongdh">Tên trường đại học</label>
			<select name="tentruongdh" id="tentruongdh">
				<option></option>
				@foreach ($data as $d )
				<option value="{{ $d->tentruong }}" {{ $getsinhvienById[0]->tentruongdh == $d->tentruong ? 'selected' : '' }}> {{ $d->tentruong }} </option>
				@endforeach
			</select>
		</div>	
		<div class="form-group">
			<label for="kode_matruong">Mã trường</label>
			<select name="kode_matruong" id="kode_matruong">
				<option></option>
				@foreach ($data as $d )
				<option value="{{ $d->matruong }}" {{ $getsinhvienById[0]->kode_matruong == $d->matruong ? 'selected' : '' }}> {{ $d->matruong }} </option>
				@endforeach
			</select>
		</div>		
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="200" value="{{ $getsinhvienById[0]->email }}"  required>
		</div>	
		<div class="form-group">
			<label for="tinhthanh">Tỉnh thành</label>
			<select name="tinhthanh" id="tinhthanh">
				<option></option>
				@foreach ($tinhthanh as $d )
				<option value="{{ $d->tendiachi }}" {{ $getsinhvienById[0]->tinhthanh == $d->tendiachi ? 'selected' : '' }}> {{ $d->tendiachi }} </option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="diachi">Địa chỉ</label>
			<input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" maxlength="250" value="{{ $getsinhvienById[0]->diachi }}" required>
		</div>
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#tinhthanh").select2({
                placeholder:"Chọn tỉnh thành",
                allowClear:true,
                // matcher: function(term, text) {
                //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
                // }
            });
        });
    </script>
	 <script type="text/javascript">
        $(document).ready(function(){
            $("#tentruongdh").select2({
                placeholder:"Chọn trường đại học",
                allowClear:true,
                // matcher: function(term, text) {
                //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
                // }
            });
        });
    </script>
	<script type="text/javascript">
        $(document).ready(function(){
            $("#kode_matruong").select2({
                placeholder:"Chọn mã trường",
                allowClear:true,
                // matcher: function(term, text) {
                //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
                // }
            });
        });
    </script>

@endsection