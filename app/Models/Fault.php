<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fault extends Model
{
    protected $fillable = [
        'device_id',
        'title',
        'description',
        'fault_date',
        'priority',
        'status',
        'diagnosis',
        'solution',
        'reported_by'
    ];
    public function items(){
        return $this->belongsTo(Device::class);
    }
    //
}
