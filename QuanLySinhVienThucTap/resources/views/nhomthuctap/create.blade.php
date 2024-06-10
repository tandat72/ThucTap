@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý nhóm thực tập')
@section('active6')
active
@endsection
@section('content')
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Quản lý nhóm thực tập</title>
    <link rel="stylesheet" href="{{asset('plugins/cssselect/virtual-select.min.css')}}">
    <script src="{{asset('plugins/jsselect/virtual-select.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .input {
            font-size: 18;
            padding: 15px 25px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
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
    <div class="col-xs-4 col-xs-offset-4">
        <center><h4>Thêm nhóm thực tập</h4></center>
        <form action="{{ url('/nhomthuctap/create') }}" method="post">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label for="idnhom">Nhóm</label>
                <input type="number" class="form-control" id="idnhom" placeholder="Nhập nhóm..." name="idnhom" />
            </div>
            <div class="form-group">
                <label for="dotthuctap">Đợt thực tập</label>
                <select class="form-control" name="dotthuctap" id="dotthuctap">
                    <option>Chọn đợt thực tập</option>
                    @foreach ($dotthuctap as $d )
                        <option value="{{$d->idthuctap}}"> {{$d->idthuctap}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Sinh viên</label>
                <select name="sinhvien" class="form-control" id="sinhvien" placeholder="Chọn sinh viên" multiple class="form-select input">
                    <option value="">Vui lòng chọn đợt thực tập...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="detai">Đề tài</label>
                <select  class="form-control"  name="detai" id="detai">
                    <option>Chọn đề tài</option>
                    @foreach ($detai as $d )
                        <option value="{{$d->tendetai}}"> {{$d->tendetai}} </option>
                    @endforeach
                </select>
            </div>  
            <div class="form-group">
                <label for="cbhd">Cán bộ hướng dẫn</label>
                <select  class="form-control"  name="cbhd" id="cbhd">
                    <option>Chọn cán bộ hướng dẫn</option>
                    @foreach ($cbhd as $d )
                        <option value="{{$d->tencanbo}}"> {{$d->tencanbo}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="donvi">Đơn vị</label>
                <select  class="form-control"  name="donvi" id="donvi">
                    <option>Chọn đơn vị</option>
                    @foreach ($donvi as $d )
                        <option value="{{$d->tendonvi}}"> {{$d->tendonvi}} </option>
                    @endforeach
                </select>
            </div>  
            <center><button type="submit" class="btn btn-primary">Thêm</button></center>
        </form>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                            // Khởi tạo VirtualSelect cho trường sinhvien
                            VirtualSelect.init({ 
                                ele: '#sinhvien' 
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
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
  {{-- <script type="text/javascript">
    $(document).ready(function(){
        $("#cbhd").select2({
            placeholder:"Chọn cán bộ hướng dẫn",
            allowClear:true,
            // matcher: function(term, text) {
            //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
            // }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#donvi").select2({
            placeholder:"Chọn đơn vị",
            allowClear:true,
            // matcher: function(term, text) {
            //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
            // }
        });
    });
</script> --}}
</body>

</html>
@endsection