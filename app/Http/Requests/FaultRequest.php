<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FaultRequest extends FormRequest
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
        'device_id'   => 'required|exists:devices,id',
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'fault_date'  => 'required|date',
        'priority'    => 'required|in:low,medium,high,critical',
        'status'      => 'required|in:pending,in_progress,resolved,closed',
        'diagnosis'   => 'nullable|string',
        'solution'    => 'nullable|string',
    ];
}
public function messages(): array
{
    return [
        'device_id.required'   => 'Cihaz seçimi zorunludur.',
        'device_id.exists'     => 'Seçilen cihaz bulunamadı.',

        'title.required'       => 'Arıza başlığı zorunludur.',
        'title.string'         => 'Arıza başlığı metin olmalıdır.',
        'title.max'            => 'Arıza başlığı en fazla 255 karakter olabilir.',

        'description.required' => 'Arıza açıklaması zorunludur.',
        'description.string'   => 'Arıza açıklaması metin olmalıdır.',

        'fault_date.required'  => 'Arıza tarihi zorunludur.',
        'fault_date.date'      => 'Geçerli bir arıza tarihi giriniz.',

        'priority.required'    => 'Öncelik seçimi zorunludur.',
        'priority.in'          => 'Öncelik; düşük, orta, yüksek veya kritik olmalıdır.',

        'status.required'      => 'Durum seçimi zorunludur.',
        'status.in'            => 'Geçersiz durum seçildi.',

        'diagnosis.string'     => 'Teşhis metin olmalıdır.',
        'solution.string'      => 'Çözüm metin olmalıdır.',
    ];
}
}
