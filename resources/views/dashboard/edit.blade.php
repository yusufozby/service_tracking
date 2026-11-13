@extends('layouts.app')

@section('title', 'Servis Düzenle')

@section('content')

@php
    $statusLabels = [
        'pending'   => 'Bekliyor',
        'continues' => 'Devam Ediyor',
        'ready'     => 'Teslime Hazır',
        'delivered' => 'Teslim Edildi',
    ];
@endphp

<div class="service-create-page">

    {{-- ================= BAŞLIK ================= --}}

    <div class="page-header">
        <div>
            <h1>Servis Düzenle</h1>
            <p>
                <span class="code">{{ $service->service_no }}</span>
                numaralı servis kaydının bilgilerini güncelleyin.
            </p>
        </div>

        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
            ← Listeye Dön
        </a>
    </div>


    {{-- ================= HATA ÖZETİ ================= --}}

    @if ($errors->any())
        <div class="alert" style="background: var(--danger-light); border-color: #fecaca; color: var(--danger-hover);">
            Lütfen formdaki hataları düzeltin.
        </div>
    @endif


    {{-- ================= FORM ================= --}}

    <form
        action="{{ route('dashboard.update', $service) }}"
        method="POST"
        class="service-form-card"
    >
        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- Servis No (salt okunur) --}}
            <div class="form-group">
                <label for="service_no">Servis No</label>
                <input
                    type="text"
                    id="service_no"
                    value="{{ $service->service_no }}"
                    readonly
                    style="background: var(--gray-100); cursor: not-allowed;"
                >
            </div>

            {{-- Durum --}}
            <div class="form-group">
                <label for="status">Durum</label>
                <select name="status" id="status" required>
                    @foreach ($statusLabels as $value => $label)
                        <option
                            value="{{ $value }}"
                            {{ old('status', $service->status) === $value ? 'selected' : '' }}
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Müşteri Adı --}}
            <div class="form-group">
                <label for="customer_name">Müşteri Adı</label>
                <input
                    type="text"
                    name="customer_name"
                    id="customer_name"
                    value="{{ old('customer_name', $service->customer_name) }}"
                    placeholder="Ad Soyad"
                    required
                >
                @error('customer_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Müşteri İletişim --}}
            <div class="form-group">
                <label for="customer_contact">İletişim</label>
                <input
                    type="text"
                    name="customer_contact"
                    id="customer_contact"
                    value="{{ old('customer_contact', $service->customer_contact) }}"
                    placeholder="Telefon veya e-posta"
                >
                @error('customer_contact')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Cihaz --}}
            <div class="form-group">
                <label for="device_id">Cihaz</label>
                <select name="device_id" id="device_id" required>
                    <option value="">Cihaz seçin</option>
                    @foreach ($devices as $device)
                        <option
                            value="{{ $device->id }}"
                            {{ (int) old('device_id', $service->device_id) === $device->id ? 'selected' : '' }}
                        >
                            {{ $device->name }}
                        </option>
                    @endforeach
                </select>
                @error('device_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Arıza --}}
            <div class="form-group">
                <label for="fault_id">Arıza</label>
                <select name="fault_id" id="fault_id" required>
                    <option value="">Arıza seçin</option>
                    @foreach ($faults as $fault)
                        <option
                            value="{{ $fault->id }}"
                            {{ (int) old('fault_id', $service->fault_id) === $fault->id ? 'selected' : '' }}
                        >
                            {{ $fault->title }}
                        </option>
                    @endforeach
                </select>
                @error('fault_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Teknisyen --}}
            <div class="form-group">
                <label for="personel_id">Teknisyen</label>
                <select name="personel_id" id="personel_id">
                    <option value="">Teknisyen seçin</option>
                    @foreach ($personels as $personel)
                        <option
                            value="{{ $personel->id }}"
                            {{ (int) old('personel_id', $service->personel_id) === $personel->id ? 'selected' : '' }}
                        >
                            {{ $personel->fullname }}
                        </option>
                    @endforeach
                </select>
                @error('personel_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Giriş Tarihi --}}
            <div class="form-group">
                <label for="date_of_entry">Giriş Tarihi</label>
                <input
                    type="date"
                    name="date_of_entry"
                    id="date_of_entry"
                    value="{{ old('date_of_entry', $service->date_of_entry ? \Carbon\Carbon::parse($service->date_of_entry)->format('Y-m-d') : '') }}"
                    required
                >
                @error('date_of_entry')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tutar --}}
            <div class="form-group">
                <label for="price">Tutar (₺)</label>
                <input
                    type="number"
                    name="price"
                    id="price"
                    step="0.01"
                    min="0"
                    value="{{ old('price', $service->price) }}"
                    placeholder="0,00"
                >
                @error('price')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

        </div>

        {{-- ================= BUTONLAR ================= --}}

        <div class="form-actions">
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                İptal
            </a>

            <button type="submit" class="btn btn-primary">
                Değişiklikleri Kaydet
            </button>
        </div>

    </form>

</div>

@endsection
