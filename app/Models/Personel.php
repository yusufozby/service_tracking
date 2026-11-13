<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    protected $fillable = [
        'fullname',
        'date_of_joining',
        'phone_number',
        'tax_number',
        'tax_office',
        'address'
    ];
    //
}
