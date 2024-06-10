<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
	<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
	{!! Toastr::message() !!}
	<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
	{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.3/select2.min.js"></script> --}}
	
	
</head>
<body>
    <div class="container">
        @section('content')
        @show
    </div>


	{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}

	<script type="text/javascript">
		$(document).ready(function() {
			$("#DataList").DataTable({
				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
				"iDisplayLength": 10,
				"oLanguage": {
					"sLengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
					"oPaginate": {
						"sFirst": "<span class='glyphicon glyphicon-step-backward' aria-hidden='true'></span>",
						"sLast": "<span class='glyphicon glyphicon-step-forward' aria-hidden='true'></span>",
						"sNext": "<span class='glyphicon glyphicon-triangle-right' aria-hidden='true'></span>",
						"sPrevious": "<span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng được tìm thấy",
					"sInfoEmpty" : "Không tìm thấy",
					"sInfoFiltered": " (trong tổng số _MAX_ dòng)"
				}
			});
		});
	</script>
	{{-- <script type="text/javascript">
	
		$(document).ready(function() { 
			$("#nameid").select2({
				placeholder:"Tìm kiếm trường",
				allowClear:true,
				matcher: function(term, text) { 
					return text.toUpperCase().indexOf(term.toUpperCase())==0; 
				}
			}); 
		});
	</script> --}}
</body>
</html>