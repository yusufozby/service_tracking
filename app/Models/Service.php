<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'device_id',
        'status',
        'fault_id',
        'service_no',
        'personel_id',
        'date_of_entry',
        'price',
        'customer_name',
        'customer_contact'
    ];
    protected static function booted(): void
{
    static::creating(function ($service) {
        do {
            $serviceNo = 'srv-' . str_pad(
                random_int(0, 99999),
                5,
                '0',
                STR_PAD_LEFT
            );
        } while (self::where('service_no', $serviceNo)->exists());

        $service->service_no = $serviceNo;
    });
}
    public function device(){
        return $this->belongsTo(Device::class);
    }
    public function fault(){
        return $this->belongsTo(Fault::class);
    }
    public function personel(){
        return $this->belongsTo(Personel::class);
    }


    //
}
