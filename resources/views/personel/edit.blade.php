
@extends('layouts.app')

@section('title', 'Personel Düzenle')

@section('content')

<div class="service-create-page">

    <div class="page-header">
        <div>
            <h1>Personel Düzenle</h1>
            <p>{{ $personel->fullname }} isimli personelin bilgilerini güncelleyin.</p>
        </div>

        <div class="page-header-actions">
            <a href="{{ route('personel.index') }}" class="btn btn-secondary">
                Geri Dön
            </a>
        </div>
    </div>

    <div class="service-form-card">

        <form action="{{ route('personel.update', $personel) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="fullname">Ad Soyad *</label>

                    <input type="text"
                           id="fullname"
                           name="fullname"
                           value="{{ old('fullname', $personel->fullname) }}"
                           placeholder="Ad ve soyad girin">

                    @error('fullname')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_of_joining">İşe Başlama Tarihi</label>

                    <input type="date"
                           id="date_of_joining"
                           name="date_of_joining"
                           value="{{ old('date_of_joining', $personel->date_of_joining ? \Carbon\Carbon::parse($personel->date_of_joining)->format('Y-m-d') : '') }}">

                    @error('date_of_joining')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Telefon Numarası</label>

                    <input type="text"
                           id="phone_number"
                           name="phone_number"
                           value="{{ old('phone_number', $personel->phone_number) }}"
                           placeholder="05XX XXX XX XX">

                    @error('phone_number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tax_number">Vergi Numarası</label>

                    <input type="text"
                           id="tax_number"
                           name="tax_number"
                           value="{{ old('tax_number', $personel->tax_number) }}"
                           placeholder="Vergi numarasını girin">

                    @error('tax_number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tax_office">Vergi Dairesi</label>

                    <input type="text"
                           id="tax_office"
                           name="tax_office"
                           value="{{ old('tax_office', $personel->tax_office) }}"
                           placeholder="Vergi dairesini girin">

                    @error('tax_office')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Adres</label>

                    <input type="text"
                           id="address"
                           name="address"
                           value="{{ old('address', $personel->address) }}"
                           placeholder="Personelin adresini girin">

                    @error('address')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('personel.index') }}" class="btn btn-secondary">
                    İptal
                </a>

                <button type="submit" class="btn btn-primary">
                    Değişiklikleri Kaydet
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
