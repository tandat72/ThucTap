@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý đơn vị')
@section('active2')
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

<?php //Form thêm mới học sinh?>
{{-- <p><a class="btn btn-primary" href="{{ url('/sinhvien') }}">Về danh sách</a></p> --}}
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Thêm đơn vị</h4></center>
	<form action="{{ url('/donvi/create') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
		<div class="form-group">
			<label for="tendonvi">Tên đơn vị</label>
			<input type="text" class="form-control" id="tendonvi" name="tendonvi" placeholder="Tên đơn vị" maxlength="30" required />
		</div>
		<div class="form-group">
			<label for="phongban">Phòng ban</label>
			<select class="form-control" name="phongban" id="phongban">
				<option>Chọn phòng ban</option>
				@foreach ($phongban as $d )
					<option value="{{$d->phongban}}"> {{$d->phongban}} </option>
				@endforeach
			</select>
		</div>
		<center><button type="submit" class="btn btn-primary">Thêm</button></center>
	</form>
</div>

@endsection