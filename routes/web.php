<?php

use App\Http\Controllers\CongviecController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HosoController;
use App\Http\Controllers\NhanvienController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'thongke'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('redirects','App\Http\Controllers\HomeController@index');

Route::controller(HosoController::class)->group(function(){
    Route::get('/hoso','index')->name('hoso')->middleware('auth');
    Route::get('/hoso/them','create')->middleware('auth');
    Route::post('/hoso/them','store')->middleware('auth');
    Route::post('/hossss','tim')->name('getcv')->middleware('auth');
    Route::get('/hoso/more/{id}','edit')->middleware('auth');
    Route::post('/hoso/savechange','savechange')->middleware('auth');
    Route::post('takehs','takehs')->name('takehs')->middleware('auth');
});

Route::controller(PhongBanController::class)->group(function(){
    Route::get('/phongban','index')->name('phongban')->middleware('auth');
    Route::post('/phongban/create','store')->middleware('auth','admin');
    Route::post('/phongban/save','savechange')->name('save_edit')->middleware('auth','admin');
    Route::post('/phongban/xoa','delete')->middleware('auth','admin');
    Route::post('/phongban/getpb','findpd')->middleware('auth');
});

Route::controller(NhanvienController::class)->group(function(){
    Route::get('/nhanvien','index')->name('nhanvien')->middleware('auth');
    Route::get('/nhanvien/create','create')->middleware('auth');
    Route::post('/nhanvien/create','store')->middleware('auth');
    Route::get('/nhanvien/profile/{id}','profile')->middleware('auth');
    Route::post('/nhanvien/avtchange','avtchange')->middleware('auth');
    Route::post('/nhanvien/savechange','savechange')->middleware('auth'); 
    Route::post('/nhanvien/delete','delete')->middleware('auth'); 
});

Route::controller(CongviecController::class)->group(function(){
    Route::get('/congviec','index')->name('congviec')->middleware('auth');
    Route::get('/congviec/them','create')->middleware('auth');
    Route::post('/congviec/them','store')->middleware('auth');
    Route::post('/congvieccccc','takenhv')->name('takenhv')->middleware('auth');
    Route::post('/congviec/changestt', 'changestt')->middleware('auth');  
    Route::get('/congviec/xemthem/{id}','xemthem')->middleware('auth','admin');
    Route::post('/congviec/savechange','savechange')->middleware('auth','admin');
    Route::post('/congviec/delete','delete')->middleware('auth','admin');
});


require __DIR__.'/auth.php';
