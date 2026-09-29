<?php

use App\Http\Controllers\dashboardContoller;
use Illuminate\Support\Facades\Route;

Route::get('/',[dashboardContoller::class,'index'])->name('dashboard.index');
