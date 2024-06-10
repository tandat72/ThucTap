@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý đề tài')
@section('active8')
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
	<center><h4>Sửa đề tài</h4></center>
	<form action="{{ url('/detai/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getdetaiById[0]->iddetai !!}" />
		<div class="form-group">
			<label for="iddetai">ID</label>
			<input type="text" class="form-control" id="iddetai" name="iddetai" placeholder="ID" value="{{ $getdetaiById[0]->iddetai }}" readonly required />
		</div>
		<div class="form-group">
			<label for="madetai">Mã đề tài</label>
			<input type="text" class="form-control" id="madetai" name="madetai" placeholder="Mã đề tài" value="{{ $getdetaiById[0]->madetai }}"  required />
		</div>
		<div class="form-group">
			<label for="tendetai">Tên đề tài</label>
			<input type="text" class="form-control" id="tendetai" name="tendetai" placeholder="Tên đề tài" value="{{ $getdetaiById[0]->tendetai }}" required />
		</div>
	
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

@endsection