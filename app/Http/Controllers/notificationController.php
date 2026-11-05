<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class notificationController extends Controller
{
    public function show(Notification $notification){
        return view('notifications.show',compact('notification'));
    }
    public function index(){

         $notifications = Notification::with('user')->get();
        return view('notifications.index',compact('notifications'));
    }
    public function filter(Request $request){
        $query = Notification::query();
        if($request->is_read){
    $query->filter('is_read',$request->is_read);
    }



        return redirect()->route('notifications.index');
    }
    //
}
