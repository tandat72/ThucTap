{{-- @extends('templates.master')
@extends('sinhvien.layouts.dashboard')

@section('title')
Trang chủ
@endsection
@section('content') --}}
{{-- <div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <script>
            alert('Bạn đã đăng nhập!')
        </script>
    {{-- {{ __('You are logged in!') }} --}}
{{-- </div> --}}
{{-- <section class="col-lg connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Thống kê
        </h3> --}}
        {{-- <div class="card-tools">
          <ul class="nav nav-pills ml-auto"> --}}
            {{-- <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
            </li> --}}
          {{-- </ul>
        </div>
      </div><!-- /.card-header -->
      @endsection --}}
@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Trang chủ')
@section('content')
<style>
	
	.icon i {
		font-size: 60px;
		margin-left: 20px;
		transition: all 0.3s ease-in-out;
	}
	.icon a{
		text-decoration: none;
	}
	.icon i:hover{
		transform: scale(1.1); 
	}
	.cbhd i{
		margin-left: 35px;
	}

</style>
{{-- <div class="page-header"><h4>Quản lý thực tập</h4></div> --}}
<div class="row">
	<div class="col-lg-3 col-6">
		<div class="student">
			<div class="icon">
				<a href="{{ url('sinhvien')}} " class="animated-link">
					<i class="fa-solid fa-graduation-cap"></i>
					<p>Quản lý sinh viên</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="truong">
			<div class="icon">
				<a href="{{ url('truong')}}">
					<i class="fa-solid fa-school"></i>
					<p>Quản lý trường</p>
				</a>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-6">
		<div class="cbhd">
			<div class="icon">
				<a href="{{ url('cbhd')}}">
					<i class="fa-solid fa-user"></i>
					<p>Cán bộ hướng dẫn</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="donvi">
			<div class="icon">
				<a href="{{ url('donvi')}}">
					<i class="fa-solid fa-building-columns"></i>
					<p>Quản lý đơn vị</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="thuctap">
			<div class="icon">
				<a href="{{ url('thuctap')}}">
					<i class="fa-solid fa-school-flag"></i>
					<p>Quản lý đợt thực tập</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="nhomthuctap">
			<div class="icon">
				<a href="{{ url('nhomthuctap')}}">
					<i class="fa-solid fa-users"></i>
					<p>Quản lý nhóm thực tập</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="detai">
			<div class="icon">
				<a href="{{ url('detai')}}">
					<i class="fa-solid fa-book"></i>
					<p>Quản lý đề tài</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="matruong">
			<div class="icon">
				<a href="{{ url('matruong')}}">
					<i class="fa-solid fa-list-ol"></i>
					<p>Danh sách mã trường</p>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
