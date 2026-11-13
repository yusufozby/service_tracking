<?php

namespace App\Http\Controllers;

use App\Http\Requests\personelRequest;
use App\Models\Personel;
use Illuminate\Http\Request;
class personelController extends Controller
{
      protected $users;
    protected $devices;

    public function __construct()
    {

        view()->share([
            'users' => $this->users,
            'devices' => $this->devices,
        ]);
    }
    public function index(Request $request){
        $query = Personel::query();
        if($request->filled('search')){
            $query->where('name','like','%'.$request->search.'%');
        }
        $personels = $query->get();
        return view('personel.index',compact('personels'));
    }
    public function edit(Personel $personel){
        return view('personel.edit',compact('personel'));
    }


    public function create(){
        return view('personel.create');
    }
    public function store(PersonelRequest $request){
        $validatedData = $request->validated();
        Personel::create($validatedData);
        return redirect()->route('personel.index')->with('success','Personel başarıyla oluşturuldu.');

    }

    public function destroy(Personel $personel){
        $personel->delete();
        return redirect()->route('personel.index')->with('success','Personel başarıyla silindi.');
    }
}
?>
