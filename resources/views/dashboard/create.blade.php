
@extends('layouts.app')

@section('title', 'Yeni Servis Oluştur')

@section('content')
@php
    $statusClasses = [
    'pending'   => 'status-waiting',
    'continues' => 'status-progress',
    'ready'     => 'status-ready',
    'delivered' => 'status-done',
];
@endphp
<div class="service-create-page">

    <div class="page-header">
        <div>
            <h1>Yeni Servis Oluştur</h1>
            <p>Yeni bir servis kaydı oluşturmak için bilgileri doldurun.</p>
        </div>

        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
            Geri Dön
        </a>
    </div>

    <div class="service-form-card">

        <form action="{{ route('dashboard.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                {{-- CİHAZ --}}
                <div class="form-group">
                    <label for="device_id">Cihaz</label>

                    <select name="device_id" id="device_id">
                        <option value="">Cihaz seçiniz</option>

                        @foreach($devices as $device)
                            <option
                                value="{{ $device->id }}"
                                {{ old('device_id') == $device->id ? 'selected' : '' }}
                            >
                                {{ $device->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('device_id')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ARIZA --}}
                <div class="form-group">
                    <label for="fault_id">Arıza Türü</label>

                    <select name="fault_id" id="fault_id">
                        <option value="">Arıza seçiniz</option>

                        @foreach($faults as $fault)
                            <option
                                value="{{ $fault->id }}"
                                {{ old('fault_id') == $fault->id ? 'selected' : '' }}
                            >
                                {{ $fault->title }}
                            </option>
                        @endforeach
                    </select>

                    @error('fault_id')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- PERSONEL --}}
                <div class="form-group">
                    <label for="personel_id">Sorumlu Personel</label>

                    <select name="personel_id" id="personel_id">
                        <option value="">Personel seçiniz</option>

                        @foreach($personels as $personel)
                            <option
                                value="{{ $personel->id }}"
                                {{ old('personel_id') == $personel->id ? 'selected' : '' }}
                            >
                                {{ $personel->fullname }}
                            </option>
                        @endforeach
                    </select>

                    @error('personel_id')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ÜCRET --}}
                <div class="form-group">
                    <label for="price">Servis Ücreti (₺)</label>

                    <input
                        type="number"
                        name="price"
                        id="price"
                        step="0.01"
                        min="0"
                        value="{{ old('price') }}"
                        placeholder="Örn. 2500.00"
                    >

                    @error('price')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- DURUM --}}
                <div class="form-group">
                    <label for="status">Servis Durumu</label>

                    <select name="status" id="status">
                        <option value="">Durum seçiniz</option>

                        <option value="pending"
                            {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                            Bekliyor
                        </option>

                        <option value="continues"
                            {{ old('status') == 'continues' ? 'selected' : '' }}>
                            Devam Ediyor
                        </option>



                        <option value="delivered"
                            {{ old('status') == 'closed' ? 'selected' : '' }}>
                            Çözüldü
                        </option>
                    </select>

                    @error('status')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- MÜŞTERİ ADI --}}
                <div class="form-group">
                    <label for="customer_name">Müşteri Adı</label>

                    <input
                        type="text"
                        name="customer_name"
                        id="customer_name"
                        value="{{ old('customer_name') }}"
                        placeholder="Müşteri adını giriniz"
                    >

                    @error('customer_name')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

                {{-- MÜŞTERİ İLETİŞİM --}}
                <div class="form-group">
                    <label for="customer_contact">Müşteri İletişim</label>

                    <input
                        type="text"
                        name="customer_contact"
                        id="customer_contact"
                        value="{{ old('customer_contact') }}"
                        placeholder="Telefon veya iletişim bilgisi giriniz"
                    >

                    @error('customer_contact')
                        <small class="error-message">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                    İptal
                </a>

                <button type="submit" class="btn btn-primary">
                    Servis Kaydını Oluştur
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
