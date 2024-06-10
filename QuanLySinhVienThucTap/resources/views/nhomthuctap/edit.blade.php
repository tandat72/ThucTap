@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý nhóm thực tập')
@section('active6')
active
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('plugins/cssselect/virtual-select.min.css')}}">
<script src="{{asset('plugins/jsselect/virtual-select.min.js')}}"></script>
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
	<center><h4>Sửa nhóm thực tập</h4></center>
	<form action="{{ url('/nhomthuctap/update') }}" method="post">
		<input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
		<input type="hidden" id="id" name="id" value="{!! $getnhomthuctapById[0]->idnhom !!}" />

		<div class="form-group">
			<label for="idnhom">Nhóm</label>
			<input type="text" class="form-control" id="idnhom" name="idnhom" placeholder="Nhóm"  value="{{ $getnhomthuctapById[0]->idnhom }}"  required />
		</div>
        <div class="form-group">
			<label for="dotthuctap">Đợt thực tập</label>
			<select class="form-control" name="dotthuctap" id="dotthuctap" >
				<option>Chọn đợt thực tập</option>
				@foreach ($thuctap as $d )
				<option value="{{ $d->idthuctap }}" {{ $getnhomthuctapById[0]->dotthuctap == $d->idthuctap ? 'selected' : '' }}> {{ $d->idthuctap }} </option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="sinhvien">Sinh viên ( chọn đợt thực tập trước )</label>
			<select class="form-control" name="sinhvien" id="sinhvien" >
				<option>Chọn đợt thực tập</option>
				@foreach ($chitiet as $d )
				<option value="{{ $d->sinhvien }}" {{ $getnhomthuctapById[0]->sinhvien == $d->sinhvien ? 'selected' : '' }}> {{ $d->sinhvien }} </option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="detai">Đề tài</label>
			<select class="form-control" name="detai" id="detai">
				<option>Chọn đề tài</option>
				@foreach ($detai as $d )
				<option value="{{ $d->tendetai }}" {{ $getnhomthuctapById[0]->detai == $d->tendetai ? 'selected' : '' }}> {{ $d->tendetai }} </option>
				@endforeach
			</select>
		</div>	
		<div class="form-group">
			<label for="cbhd">Cán bộ hướng dẫn</label>
			<select class="form-control" name="cbhd" id="cbhd">
				<option>Chọn cán bộ hướng dẫn</option>
				@foreach ($cbhd as $d )
				<option value="{{ $d->tencanbo }}" {{ $getnhomthuctapById[0]->cbhd == $d->tencanbo ? 'selected' : '' }}> {{ $d->tencanbo }} </option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="donvi">Đơn vị</label>
			<select class="form-control" name="donvi" id="donvi">
				<option>Chọn đơn vị</option>
				@foreach ($donvi as $d )
				<option value="{{ $d->tendonvi }}" {{ $getnhomthuctapById[0]->donvi == $d->tendonvi ? 'selected' : '' }}> {{ $d->tendonvi }} </option>
				@endforeach
			</select>
		</div>
	
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>
<script>
	$(document).ready(function() {
  
  $('#dotthuctap').on('change', function() {
	  var id_test = $(this).val();
	  if (id_test) {
		  $.ajax({
			  url: '/nhomthuctap/' + id_test,
			  type: 'GET',
			  data: {
				  '_token': '{{ csrf_token() }}'
			  },
			  dataType: 'json',
			  success: function(data) {
				  if (data) {
					  $('#sinhvien').empty();
					  $('#sinhvien').append('');
					  $.each(data, function(key, sinhvien) {
						  $('#sinhvien').append(
							  '<option value="' + sinhvien.sinhvien + '">' +
								  sinhvien.sinhvien + '</option>'
						  );
					  });
					
				  } else {
					  $('#sinhvien').empty();
				  }
			  }
		  });
		  
	  } else {
		  $('#sinhvien').empty();
	  }
  });
});
</script>
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
            $("#truong").select2({
                placeholder:"Chọn trường đại học",
                allowClear:true,
                // matcher: function(term, text) {
                //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
                // }
            });
        });
    </script>
 <script>
	var donviSelect = document.getElementById("cbhd");
var phongbanSelect = document.getElementById("donvi");

donviSelect.addEventListener("change", function() {
	var selectedDonvi = donviSelect.value;

	// Clear existing options
	phongbanSelect.innerHTML = "";

	// Add options based on the selected unit
	@foreach ($cbhd as $d )
	if ("{{ $d->tencanbo }}" === selectedDonvi) {
		var option = document.createElement("option");
		option.value = "{{ $d->tendonvi }}";
		option.text = "{{ $d->tendonvi }}";
		phongbanSelect.add(option);
	}
	@endforeach
});
</script>
@endsection