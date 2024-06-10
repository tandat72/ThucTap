@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý cán bộ hướng dẫn')
@section('active5')
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
	<center><h4>Sửa cán bộ HD</h4></center>
	<form action="{{ url('/cbhd/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getcbhdById[0]->id !!}" />
		<div class="form-group">
			<label for="id">ID</label>
			<input type="text" class="form-control" id="id" name="id" placeholder="stt" maxlength="20" value="{{ $getcbhdById[0]->id }}" readonly required />
		</div>
		<div class="form-group">
			<label for="macbhd">MSCB</label>
			<input type="text" class="form-control" id="macbhd" name="macbhd" placeholder="Mã cán bộ HD" maxlength="100" value="{{ $getcbhdById[0]->macbhd }}"  required />
		</div>
		<div class="form-group">
			<label for="tencanbo">Tên cán bộ</label>
			<input type="text" class="form-control" id="tencanbo" name="tencanbo" placeholder="Tên cán bộ" maxlength="200" value="{{ $getcbhdById[0]->tencanbo }}" required />
		</div>
		<div class="form-group">
			<label for="donvi">Đơn vị</label>
			<select class="form-control" style="width: 200px;" name="tendonvi" id="tendonvi" maxlength="70">
				<option value="">Chọn đơn vị</option>
				@foreach ($donvi as $d )
				<option value="{{ $d->tendonvi }}" {{ $getcbhdById[0]->tendonvi == $d->tendonvi ? 'selected' : '' }}> {{ $d->tendonvi }} </option>
				@endforeach
			</select>
		</div>		
        <div class="form-group">
			<label for="phongban">Phòng ban</label>
			<select class="form-control" style="width: 200px;" name="phongban" id="phongban" maxlength="70">
				<option value="">Chọn phòng ban</option>
				@foreach ($donvi as $d )
				<option value="{{ $d->phongban }}" {{ $getcbhdById[0]->phongban == $d->phongban ? 'selected' : '' }}> {{ $d->phongban }} </option>
				@endforeach
			</select>
		</div>		
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>
<script>
    var donviSelect = document.getElementById("tendonvi");
    var phongbanSelect = document.getElementById("phongban");

    donviSelect.addEventListener("change", function() {
        var selectedDonvi = donviSelect.value;

        // Clear existing options
        phongbanSelect.innerHTML = "";

        // Add options based on the selected unit
        @foreach ($donvi as $d )
        if ("{{ $d->tendonvi }}" === selectedDonvi) {
            var option = document.createElement("option");
            option.value = "{{ $d->phongban }}";
            option.text = "{{ $d->phongban }}";
            phongbanSelect.add(option);
        }
        @endforeach
    });
</script>
@endsection