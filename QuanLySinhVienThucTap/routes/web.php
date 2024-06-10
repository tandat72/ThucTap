<?php

use App\Http\Controllers\NhomthuctapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\TruongController;
use App\Http\Controllers\ThuctapController;
use App\Http\Controllers\SinhvienController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('matruong', 'MatruongController@index'); // Hiển thị danh sách học sinh
Route::post('/export-csv2','MatruongController@export_csv2');
Route::post('/import-csv2','MatruongController@import_csv2');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sinhvien', 'SinhvienController@index'); // Hiển thị danh sách học sinh
Route::get('sinhvien/create', 'SinhvienController@create'); // Thêm mới học sinh
Route::post('sinhvien/create', 'SinhvienController@store'); // Xử lý thêm mới học sinh
Route::get('sinhvien/{id}/edit', 'SinhvienController@edit'); // Sửa học sinh
Route::post('sinhvien/update', 'SinhvienController@update'); // Xử lý sửa học sinh
Route::get('sinhvien/{id}/delete', 'SinhvienController@destroy'); // Xóa học sinh
Route::post('/export-csv','SinhvienController@export_csv');
Route::post('/import-csv','SinhvienController@import_csv');
Route::get('/sinhvien', 'SinhvienController@index')->name('sinhvien.index');

Route::get('donvi', 'DonviController@index'); // Hiển thị danh sách học sinh
Route::get('donvi/create', 'DonviController@create'); // Thêm mới học sinh
Route::post('donvi/create', 'DonviController@store'); // Xử lý thêm mới học sinh
Route::get('donvi/{id}/edit', 'DonviController@edit'); // Sửa học sinh
Route::post('donvi/update', 'DonviController@update'); // Xử lý sửa học sinh
Route::get('donvi/{id}/delete', 'DonviController@destroy'); // Xóa học sinh

Route::get('/donvi', 'DonviController@index')->name('donvi.index');

Route::get('truong', 'TruongController@index'); // Hiển thị danh sách học sinh
Route::get('truong/create', 'TruongController@create'); // Thêm mới học sinh
Route::post('truong/create', 'TruongController@store'); // Xử lý thêm mới học sinh
Route::get('truong/{id}/edit', 'TruongController@edit'); // Sửa học sinh
Route::post('truong/update', 'TruongController@update'); // Xử lý sửa học sinh
Route::get('truong/{id}/delete', 'TruongController@destroy'); // Xóa học sinh
Route::post('/export-csv3','TruongController@export_csv3');
Route::post('/import-csv3','TruongController@import_csv3');

Route::get('/truong', 'TruongController@index')->name('truong.index');

Route::get('cbhd', 'CanbohuongdanController@index'); // Hiển thị danh sách học sinh
Route::get('cbhd/create', 'CanbohuongdanController@create'); // Thêm mới học sinh
Route::post('cbhd/create', 'CanbohuongdanController@store'); // Xử lý thêm mới học sinh
Route::get('cbhd/{id}/edit', 'CanbohuongdanController@edit'); // Sửa học sinh
Route::post('cbhd/update', 'CanbohuongdanController@update'); // Xử lý sửa học sinh
Route::get('cbhd/{id}/delete', 'CanbohuongdanController@destroy'); // Xóa học sinh

Route::get('/cbhd', 'CanbohuongdanController@index')->name('cbhd.index');


Route::get('thuctap','ThuctapController@index');
Route::get('thuctap/create','ThuctapController@create');
Route::post('thuctap/create','ThuctapController@store');
Route::get('thuctap/{id}/edit', 'ThuctapController@edit'); // Sửa học sinh
Route::post('thuctap/update', 'ThuctapController@update'); 
Route::get('thuctap/{id}/delete','ThuctapController@destroy');
Route::get('thuctap/{id}', [ThuctapController::class, 'getBarang']);//liên két url
Route::post('insert', [ThuctapController::class, 'insert']);
Route::post('/export-csv4','ThuctapController@export_csv4');
Route::post('/import-csv4','ThuctapController@import_csv4');
Route::get('/thuctap/storeDetail', 'ThuctapController@storeDetail')->name('thuctap.storeDetail');
Route::get('/thuctap', 'ThuctapController@index')->name('thuctap.index');

Route::get('nhomthuctap','NhomthuctapController@index');
Route::get('nhomthuctap/create','NhomthuctapController@create');
Route::post('nhomthuctap/create','NhomthuctapController@store');
Route::get('nhomthuctap/{id}/edit', 'NhomthuctapController@edit'); // Sửa học sinh
Route::post('nhomthuctap/update', 'NhomthuctapController@update'); 
Route::get('nhomthuctap/{id}/delete', 'NhomthuctapController@destroy'); // Xóa học sinh

Route::get('nhomthuctap/{id}', [NhomthuctapController::class, 'getBarang']);//liên két url
Route::post('nhomthuctap', [NhomthuctapController::class, 'insert']);

Route::get('detai','DetaiController@index');
Route::get('detai/create','DetaiController@create');
Route::post('detai/create','DetaiController@store');
Route::get('detai/{id}/delete','DetaiController@destroy');
Route::get('detai/{id}/edit','DetaiController@edit');
Route::post('detai/update','DetaiController@update');




/////'Test'/////


Route::get('/test', 'TestController@index')->name('test.index'); 

// Trang tạo mới
Route::get('/test/create', 'TestController@create')->name('test.create');

// Xử lý submit form
Route::post('/test/create', 'TestController@store')->name('test.store'); 
Route::get('/test/edit', [TestController::class, 'edit']);// Tách chi tiết 
Route::post('/test/update', [TestController::class, 'update']);// Tách chi tiết 
Route::get('/test/storeDetail', 'TestController@storeDetail')->name('test.storeDetail');
Route::get('/test/{id}', 'TestController@getBarang');
// Route::get('/sinhvien/{id}', 'SinhvienController@show');


