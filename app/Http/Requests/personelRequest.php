<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class personelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); // Kullanıcının yetkili olup olmadığını kontrol et
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'date_of_joining' => 'nullable|date',
            'phone_number' => 'nullable|string|max:20',
            'tax_number' => 'nullable|string|max:20',
            'tax_office' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255'
        ];
    }
public function messages(): array
{
    return [
        'fullname.required'       => 'Ad soyad zorunludur.',
        'fullname.string'         => 'Ad soyad metin olmalıdır.',
        'fullname.max'            => 'Ad soyad en fazla 255 karakter olabilir.',

        'date_of_joining.date'    => 'Geçerli bir işe giriş tarihi giriniz.',

        'phone_number.string'     => 'Telefon numarası metin olmalıdır.',
        'phone_number.max'        => 'Telefon numarası en fazla 20 karakter olabilir.',

        'tax_number.string'       => 'Vergi numarası metin olmalıdır.',
        'tax_number.max'          => 'Vergi numarası en fazla 20 karakter olabilir.',

        'tax_office.string'       => 'Vergi dairesi metin olmalıdır.',
        'tax_office.max'          => 'Vergi dairesi en fazla 255 karakter olabilir.',

        'address.string'          => 'Adres metin olmalıdır.',
        'address.max'             => 'Adres en fazla 255 karakter olabilir.',
    ];
}
}
