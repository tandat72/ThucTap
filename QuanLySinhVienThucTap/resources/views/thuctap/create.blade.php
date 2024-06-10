@extends('templates.master')
@extends('sinhvien.layouts.dashboard')
@section('title','Quản lý đợt thực tập')
@section('active3')
active
@endsection
@section('content')
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Quản lý đợt thực tập</title>
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
        <center><h4>Thêm đợt thực tập</h4></center>
        <form action="{{ url('/thuctap/create') }}" method="post">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
           
           
            {{-- <div class="form-group">
                <label for="matruong">Mã trường</label>
                <select name="matruong" id="matruong">
                    <option></option>
                    @foreach ($truong as $d )
                        <option value="{{$d->matruong}}"> {{$d->matruong}} </option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="idthuctap">Đợt thực tập</label>
                <input type="id" class="form-control" id="idthuctap" placeholder="Nhập đợt thực tập..." name="idthuctap" />
            </div>
            <div class="form-group">
                <label for="madotthuctap">Mã đợt thực tập</label>
                <input type="text" class="form-control" id="madotthuctap" placeholder="Nhập mã đợt thực tập..." name="madotthuctap" />
            </div>
            <div class="form-group">
                <label for="truong">Trường</label>
                <select name="truong" id="truong">
                    <option></option>
                    @foreach ($truong as $d )
                        <option value="{{$d->tentruong}}"> {{$d->tentruong}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Sinh viên</label>
                <select name="sinhvien" class="form-control" id="sinhvien" placeholder="Chọn sinh viên" multiple class="form-select input">
                    <option value="">Vui lòng chọn trường...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tgbd">Thời gian bắt đầu</label>
                <input type="date" class="form-control" id="tgbd" name="tgbd" />
            </div>
            <div class="form-group">
                <label for="tgkt">Thời gian kết thúc</label>
                <input type="date" class="form-control" id="tgkt"  name="tgkt"  />
            </div>
            <center><button type="submit" class="btn btn-primary">Thêm</button></center>

        </form>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        
     $(document).ready(function() {
        
    $('#truong').on('change', function() {
        var tentruongdh = $(this).val();
        if (tentruongdh) {
            $.ajax({
                url: '/thuctap/' + tentruongdh,
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
                                '<option value="' + sinhvien.tensinhvien + '">' +
                                    sinhvien.tensinhvien + '</option>'
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
        // function insertData() {
        //     var truong = $('#truong option:selected').text();
        //     var sinhvien = $('#sinhvien option:selected').text();
        //     var matruong = $('#matruong option:selected').text();
        //     var tgbd = $('#tgbd').val();
        //     var tgkt = $('#tgkt').val();
        //     if (truong && sinhvien && matruong && tgbd  && tgkt) {
        //         $.ajax({
        //             url: '/insert',
        //             type: 'POST',
        //             data: {
        //                 '_token': '{{ csrf_token() }}',
        //                 'truong': truong,
        //                 'sinhvien': sinhvien,
        //                 'matruong' : matruong,
        //                 'tgbd' : tgbd,
        //                 'tgkt' : tgkt
        //             },
        //             dataType: 'json',
        //             success: function(data) {
        //                 if (data.success) {
        //                     // Hiển thị tên kategori và barang sau khi insert thành công
        //                     $('#truong-label').text(truong);
        //                     $('#sinhvien-label').text(sinhvien);
        //                     $('#matruong-label').text(matruong);
        //                     $('#tgbd-label').text(tgbd);
        //                     $('#tgkt-label').text(tgkt);
        //                     alert('Thêm thành công');
        //                 } else {
        //                     alert('Xảy ra lỗi');
        //                 }
        //             }
        //         });
        //     } else {
        //         alert('Vui lòng nhập đầy đủ thông tin');
        //     }
        // }
    </script>
    <script>
        $(document).ready(function() {
            $('#truong').on('change', function() {
                var selectedTruong = $(this).val();
                var matruongDropdown = $('#matruong');
                var selectedMatruongOption = matruongDropdown.find('option[value="' + selectedTruong + '"]');
                
                if (selectedMatruongOption.length > 0) {
                    matruongDropdown.val(selectedTruong).trigger("change.select2");
                } else {
                    matruongDropdown.val('').trigger("change.select2");
                }
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script>
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
     <script type="text/javascript">
        $(document).ready(function(){
            $("#matruong").select2({
                placeholder:"Chọn mã trường",
                allowClear:true,
                // matcher: function(term, text) {
                //     return text.toUpperCase().indexOf(term.toUpperCase())==0;
                // }
            });
        });
    </script>
</body>

</html>
@endsection