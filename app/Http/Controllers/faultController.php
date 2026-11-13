<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaultRequest;
use App\Models\Device;
use App\Models\Fault;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class faultController extends Controller
{
    protected $users;
    protected $devices;

    public function __construct()
    {
        $this->users = User::all();
        $this->devices = Device::all();

        view()->share([
            'users' => $this->users,
            'devices' => $this->devices,
        ]);
    }

    public function index()
    {
        $faults = Fault::all();

        return view('fault.index', compact('faults'));
    }

    public function create()
    {
        return view('fault.create');
    }

    public function store(FaultRequest $request)
    {
        $data = $request->validated();
        $data['reported_by'] = Auth::id();

        Fault::create($data);

        return redirect()->route('fault.index');
    }

    public function edit(Fault $fault)
    {
        return view('fault.edit', compact('fault'));
    }

    public function update(FaultRequest $request, Fault $fault)
    {
        $fault->update($request->validated());

        return redirect()->route('fault.index');
    }

    public function show(Fault $fault)
    {
        return view('fault.show', compact('fault'));
    }

    public function destroy(Fault $fault)
    {
        $fault->delete();

        return redirect()->route('fault.index');
    }
}

