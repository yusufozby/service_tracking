<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
     use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'serial_no',
        'model',
        'personel_id',
        'type',
        'status',

    ];
    public function personel(){
        return $this->belongsTo(Personel::class);
    }
    //
}
