<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Device;
use App\Models\Fault;
use App\Models\Personel;
use App\Models\Service;
use Illuminate\Http\Request;

class dashboardContoller extends Controller
{
       protected $faults;
    protected $devices;
    protected $personels;
    protected $services;

    public function __construct()
    {
        $this->faults = Fault::all();
        $this->devices = Device::all();
        $this->personels = Personel::all();
        $this->services = Service::all();

        view()->share([
            'faults' => $this->faults,
            'devices' => $this->devices,
            'personels' => $this->personels,
            'services' => $this->services,
        ]);
    }
    public function edit(Service $service){
        $devices   = $this->devices;
        $faults    = $this->faults;
        $personels = $this->personels;
        return view('dashboard.edit',compact('service','devices','faults','personels'));
    }
 public function index(){
$services = $this->services;
      return view('dashboard.index',compact('services'));
 }
 public function create(){

    $devices   = $this->devices;
    $faults    = $this->faults;
    $personels = $this->personels;
    return view('dashboard.create',compact('devices','faults','personels'));
 }
 public function store(ServiceRequest $request){
    $data = $request->validated();
    $data['date_of_entry'] = now();
    $data['service_no'] = 'srv-' . random_int(10000, 99999);
    Service::create($data);
    return redirect()->route('dashboard.index')->with('success','Service created successfully');

 }
 public function destroy(Service $service){
    $service->delete();
    return redirect()->route('dashboard.index')->with('success','Service deleted successfully');

 }
 public function update(ServiceRequest $request, Service $service){
    $data = $request->validated();
    $service->update($data);
    return redirect()->route('dashboard.index')->with('success','Service updated successfully');

 }
 public function schedule(){
$services = $this->services;
    return view('schedule.index',compact('services'));
 }

}
