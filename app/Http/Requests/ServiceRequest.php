<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

        'device_id'=>'required|exists:devices,id',
        'fault_id'=>'required|exists:faults,id',
        'personel_id'=>'required|exists:personels,id',
        'status'=>'required|in:pending,continues,delivered,ready',
        'price'=>'required|numeric',
        'customer_name'=>'required|string|max:255',
        'customer_contact'=>'required|string|max:255',

    ];

    }
public function messages(): array
{
    return [
        'device_id.required'        => 'Cihaz seçimi zorunludur.',
        'device_id.exists'          => 'Seçilen cihaz bulunamadı.',

        'fault_id.required'         => 'Arıza seçimi zorunludur.',
        'fault_id.exists'           => 'Seçilen arıza kaydı bulunamadı.',

        'personel_id.required'      => 'Personel seçimi zorunludur.',
        'personel_id.exists'        => 'Seçilen personel bulunamadı.',

        'status.required'           => 'Servis durumu zorunludur.',
        'status.in'                 => 'Servis durumu; beklemede, devam ediyor, hazır veya teslim edildi olmalıdır.',

        'price.required'            => 'Ücret bilgisi zorunludur.',
        'price.numeric'             => 'Ücret sayısal bir değer olmalıdır.',

        'customer_name.required'    => 'Müşteri adı zorunludur.',
        'customer_name.string'      => 'Müşteri adı metin olmalıdır.',
        'customer_name.max'         => 'Müşteri adı en fazla 255 karakter olabilir.',

        'customer_contact.required' => 'Müşteri iletişim bilgisi zorunludur.',
        'customer_contact.string'   => 'Müşteri iletişim bilgisi metin olmalıdır.',
        'customer_contact.max'      => 'Müşteri iletişim bilgisi en fazla 255 karakter olabilir.',
    ];
}
}
