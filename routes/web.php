<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardContoller;
use App\Http\Controllers\deviceController;
use App\Http\Controllers\faultController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\personelController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\scheduleController;
use App\Http\Controllers\saleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
Route::get('/',[dashboardContoller::class,'index'])->name('dashboard.index');
Route::get('/noticifications',[notificationController::class,'index'])->name('notifications.index');
Route::get('/schedule',[dashboardContoller::class,'schedule'])->name('schedule.index');
Route::get('/report',[reportController::class,'index'])->name('report.index');
Route::get('/devices',[deviceController::class,'index'])->name('device.index');
Route::get('/device/edit/{device}',[deviceController::class,'edit'])->name('device.edit');
Route::get('/device/detail/{device}',[deviceController::class,'detail'])->name('device.detail');
Route::get('/sales',[saleController::class,'index'])->name('sale.index');
Route::put('/device/update/{device}',[deviceController::class,'update'])->name('device.update');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/create-device',[deviceController::class,'createDevice'])->name('device.createForm');
Route::get('/device/create',[deviceController::class,'create'])->name('device.create');
Route::post('/notifications/filter',[notificationController::class,'filter'])->name('notifications.filter');
Route::get('/faults',[faultController::class,'index'],)->name('fault.index');
Route::delete('/device/delete/{device}',[deviceController::class,'delete'])->name('device.delete');
Route::get('/notification/show/{notification}',[notificationController::class,'show'])->name('notifications.show');
Route::get('/faults',[faultController::class,'index'])->name('fault.index');
Route::get('/fault/create',[faultController::class,'create'])->name('fault.create');
Route::post('/fault/store',[faultController::class,'store'])->name('fault.store');
Route::put('/fault/update/{fault}',[faultController::class,'update'])->name('fault.update');
Route::get('/fault/edit/{fault}',[faultController::class,'edit'])->name('fault.edit');
Route::get('/fault/show/{fault}',[faultController::class,'show'])->name('fault.show');
Route::get('/service/create',[dashboardContoller::class,'create'])->name('dashboard.create');
Route::post('/service/store',[dashboardContoller::class,'store'])->name('dashboard.store');
Route::put('/service/update/{service}',[dashboardContoller::class,'update'])->name('dashboard.update');
Route::get('/service/edit/{service}',[dashboardContoller::class,'edit'])->name('dashboard.edit');
Route::delete('/fault/delete/{fault}',[faultController::class,'destroy'])->name('fault.destroy');
Route::delete('/service/delete/{service}',[dashboardContoller::class,'destroy'])->name('dashboard.destroy');
Route::get('/personels',[personelController::class,'index'])->name('personel.index');
Route::get('/personel/create',[personelController::class,'create'])->name('personel.create');
Route::post('/personel/store',[personelController::class,'store'])->name('personel.store');
Route::get('/personel/edit/{personel}',[personelController::class,'edit'])->name('personel.edit');
Route::put('/personel/update/{personel}',[personelController::class,'update'])->name('personel.update');
Route::delete('/personel/delete/{personel}',[personelController::class,'destroy'])->name('personel.destroy');
});

Route::middleware('guest')->group(function(){
    Route::post('/login-form',[AuthController::class,'loginForm'])->name('loginForm');
    Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::get('/verify-code',[AuthController::class,'verifyCode'])->name('verify-code');
Route::post('/verify-form',[AuthController::class,'verifyCodeForm'])->name('verify-form');
Route::post('/create-user',[AuthController::class,'createUser'])->name('create-user');
Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('forgot-password');
});

