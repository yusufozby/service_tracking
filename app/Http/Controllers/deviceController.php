<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class deviceController extends Controller
{
    public function create(){
            $personels = Personel::all();
        return view('device.create',compact('personels'));
    }
    public function index(Request $request){
        $query = Device::query();
          $fullDevices = (clone $query)->get();
        if($request->filled('status')){
            $query->where('status',$request->status);
        }
        if($request->filled('search')){
            $search = $request->input('search');
    $query->where(function ($q) use($search)  {

        $q->where('name', 'LIKE', "%{$search}%")
          ->orWhere('model', 'LIKE', "%{$search}%")
          ->orWhere('serial_no', 'LIKE', "%{$search}%");

    });
        }
        $devices = $query->paginate(10)->withQueryString();


        return view('device.index',compact('devices','fullDevices'));
    }
    public function detail(Device $device)  {

          return view('device.detail',compact('device'));


    }
    public function edit(Device $device){
        $personels = Personel::all();




         return view('device.edit',compact('device','personels'));
    }
    public function delete(Device $device){
        $device->delete();
        return redirect()->route('device.index');

    }

public function createDevice(Request $request){
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'serial_no'   => 'required|string|max:255',
        'model'       => 'nullable|string|max:255',
        'type'        => 'nullable|string|max:255',
        'status'      => 'required|in:active,onService,passive',
        'personel_id' => 'nullable|integer|exists:personels,id',
        'image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
    ]);
    if($request->hasFile('image')){
   $validated['image'] =     $request->file('image')->store('devices','public');
    }
Device::create($validated);
return redirect()->route('device.index');
}

    public function update(Request $request, Device $device)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'serial_no'   => 'required|string|max:255',
        'model'       => 'nullable|string|max:255',
        'type'        => 'nullable|string|max:255',
        'status'      => 'required|in:active,onService,passive',
        'personel_id' => 'nullable|integer|exists:personels,id',
        'image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // eski resmi sil (opsiyonel)
        if ($device->image) {
            Storage::disk('public')->delete($device->image);
        }

        $validated['image'] = $request->file('image')->store('devices', 'public');
    } else {
        unset($validated['image']); // resim seçilmediyse mevcut resmi koru
    }

    $device->update($validated);

    return redirect()
        ->route('device.index')
        ->with('success', 'Cihaz güncellendi.');
}
}
