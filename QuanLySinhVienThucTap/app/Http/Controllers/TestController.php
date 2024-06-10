<?php

namespace App\Http\Controllers;
use App\Sinhvien;
use App\Test;
use App\Chitiet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Pagination\Paginator;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Maatwebsite\Excel\Facades\Excel;
class TestController extends Controller
{
	public function index()
  {
    $test = Test::all();
    return view('test.list',compact('test'));
  }
  public function create()
  {
    return view('test.create');
  }
}
