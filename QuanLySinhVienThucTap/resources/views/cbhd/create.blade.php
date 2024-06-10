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

<?php //Form thêm mới học sinh?>
{{-- <p><a class="btn btn-primary" href="{{ url('/sinhvien') }}">Về danh sách</a></p> --}}
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Thêm cán bộ HD</h4></center>
	<form action="{{ url('/cbhd/create') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
		<div class="form-group">
			<label for="macbhd">Mã cán bộ Hd</label>
			<input type="number" class="form-control" id="macbhd" name="macbhd" placeholder="Mã cán bộ HD" maxlength="20" prequired />
		</div>
		<div class="form-group">
			<label for="tencanbo">Tên cán bộ HD</label>
			<input type="text" class="form-control" id="tencanbo" name="tencanbo" placeholder="Tên cán bộ" maxlength="40" required />
		</div>
		<div class="form-group">
			<label for="donvi">Đơn vị</label>
			<select  class="form-control" name="tendonvi" id="tendonvi">
				<option>Chọn đơn vị</option>
				@foreach ($donvi as $d )
					<option value="{{$d->tendonvi}}"> {{$d->tendonvi}} </option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="phongban">Phòng ban</label>
			<select  class="form-control" name="phongban" id="phongban">
				<option>Chọn phòng ban</option>
				@foreach ($donvi as $d )
					<option value="{{$d->phongban}}"> {{$d->phongban}} </option>
				@endforeach
			</select>
		</div>
		<center><button type="submit" class="btn btn-primary">Thêm</button></center>
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