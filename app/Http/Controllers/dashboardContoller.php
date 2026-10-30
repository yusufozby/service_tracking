<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class dashboardContoller extends Controller
{
 public function index(){
$services = Service::all();
      return view('dashboard.index',compact('services'));
 }
    //
}
