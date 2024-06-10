@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý sinh viên')
@section('active4')
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
	<center><h4>Sửa tên trường</h4></center>
	<form action="{{ url('/truong/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
        <div class="form-group">
			<label for="idtruong">ID</label>
			<input type="text" class="form-control" id="idtruong" name="idtruong" placeholder="ID" maxlength="20" value="{{ $gettruongById[0]->idtruong }}" readonly required />
		</div>
		<div class="form-group">
			<label for="matruong">Mã trường</label>
			<input type="text" class="form-control" id="matruong" name="matruong" placeholder="Mã trường" maxlength="40" value="{{ $gettruongById[0]->matruong }}" required />
		</div>
		<div class="form-group">
			<label for="tentruong">Tên trường</label>
			<input type="text" class="form-control" id="tentruong" name="tentruong" placeholder="Tên trường" maxlength="40" value="{{ $gettruongById[0]->tentruong }}" required />
		</div>
		<center><button type="submit" class="btn btn-primary">Sửa</button></center>
	</form>
</div>

@endsection