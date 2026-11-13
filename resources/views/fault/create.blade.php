@extends('layouts.app')

@section('title', 'Yeni Arıza')

@section('content')

<div class="fault-create-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-title">
            <h1>Yeni Arıza</h1>
            <p>Sisteme yeni bir arıza kaydı ekleyin.</p>
        </div>

        <div class="page-header-actions">
            <a href="{{ route('fault.index') }}" class="fault-back-button">
                <i class="fa-solid fa-arrow-left"></i>
                Geri Dön
            </a>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="fault-create-card">

        <div class="fault-create-header">
            <div class="fault-create-header-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>

            <div>
                <h3>Arıza Bilgileri</h3>
                <p>Eklemek istediğiniz arızanın bilgilerini girin.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('fault.store') }}">
            @csrf

            <div class="fault-create-body">

                {{-- DEVICE_ID --}}
                <div class="fault-form-group">
                    <label for="device_id">
                        Cihaz
                        <span class="required">*</span>
                    </label>

                    <select
                        id="device_id"
                        name="device_id"
                        class="@error('device_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Cihaz seçiniz</option>
                        @foreach($devices as $device)
                            <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                {{ $device->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('device_id')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- REPORTED_BY --}}


                {{-- TITLE --}}
                <div class="fault-form-group">
                    <label for="title">
                        Başlık
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        maxlength="255"
                        placeholder="Örn: Motor çalışmıyor"
                        class="@error('title') is-invalid @enderror"
                        required
                    >

                    @error('title')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- DESCRIPTION --}}
                <div class="fault-form-group">
                    <label for="description">
                        Açıklama
                        <span class="required">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Arıza hakkında açıklama giriniz..."
                        class="@error('description') is-invalid @enderror"
                        required
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- FAULT_DATE --}}
                <div class="fault-form-group">
                    <label for="fault_date">
                        Arıza Tarihi
                        <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        id="fault_date"
                        name="fault_date"
                        value="{{ old('fault_date', date('Y-m-d')) }}"
                        class="@error('fault_date') is-invalid @enderror"
                        required
                    >

                    @error('fault_date')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- PRIORITY --}}
                <div class="fault-form-group">
                    <label for="priority">
                        Öncelik
                        <span class="required">*</span>
                    </label>

                    <select
                        id="priority"
                        name="priority"
                        class="@error('priority') is-invalid @enderror"
                        required
                    >
                        <option value="low"      {{ old('priority') == 'low' ? 'selected' : '' }}>Düşük</option>
                        <option value="medium"   {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Orta</option>
                        <option value="high"     {{ old('priority') == 'high' ? 'selected' : '' }}>Yüksek</option>
                        <option value="critical" {{ old('priority') == 'critical' ? 'selected' : '' }}>Kritik</option>
                    </select>

                    @error('priority')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="fault-form-group">
                    <label for="status">
                        Durum
                        <span class="required">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="@error('status') is-invalid @enderror"
                        required
                    >
                        <option value="pending"     {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Beklemede</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Devam Ediyor</option>
                        <option value="resolved"    {{ old('status') == 'resolved' ? 'selected' : '' }}>Çözüldü</option>
                        <option value="closed"      {{ old('status') == 'closed' ? 'selected' : '' }}>Kapatıldı</option>
                    </select>

                    @error('status')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- DIAGNOSIS --}}
                <div class="fault-form-group">
                    <label for="diagnosis">Teşhis</label>

                    <textarea
                        id="diagnosis"
                        name="diagnosis"
                        rows="4"
                        placeholder="Arıza teşhisini giriniz..."
                        class="@error('diagnosis') is-invalid @enderror"
                    >{{ old('diagnosis') }}</textarea>

                    @error('diagnosis')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- SOLUTION --}}
                <div class="fault-form-group">
                    <label for="solution">Çözüm</label>

                    <textarea
                        id="solution"
                        name="solution"
                        rows="4"
                        placeholder="Uygulanan çözümü giriniz..."
                        class="@error('solution') is-invalid @enderror"
                    >{{ old('solution') }}</textarea>

                    @error('solution')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- RESOLVED_AT --}}
                <div class="fault-form-group">
                    <label for="resolved_at">Çözüm Tarihi</label>

                    <input
                        type="datetime-local"
                        id="resolved_at"
                        name="resolved_at"
                        value="{{ old('resolved_at') }}"
                        class="@error('resolved_at') is-invalid @enderror"
                    >

                    @error('resolved_at')
                        <span class="fault-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- FORM FOOTER --}}
            <div class="fault-create-footer">

                <a href="{{ route('fault.index') }}" class="fault-cancel-button">
                    İptal
                </a>

                <button type="submit" class="fault-save-button">
                    <i class="fa-solid fa-check"></i>
                    Arızayı Kaydet
                </button>

            </div>

        </form>

    </div>

</div>

<style>

/* ========================================
   GENERAL
======================================== */

.fault-create-page {
    width: 90%;
    margin: 30px auto;
}

/* ========================================
   CARD
======================================== */

.fault-create-card {
    background: #fff;
    border: 1px solid var(--gray-200);
    border-radius: 14px;
    overflow: hidden;
}

.fault-create-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--gray-200);
}

.fault-create-header-icon {
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: var(--primary-light);
    color: var(--primary);
    font-size: 18px;
}

.fault-create-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-900);
}

.fault-create-header p {
    margin-top: 5px;
    font-size: 12px;
    color: var(--text-secondary);
}

/* ========================================
   FORM BODY
======================================== */

.fault-create-body {
    padding: 25px 24px;
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.fault-form-group {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.fault-form-group > label {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-800);
}

.fault-form-group .required {
    color: var(--danger);
}

.fault-form-group input[type="text"],
.fault-form-group input[type="date"],
.fault-form-group input[type="datetime-local"],
.fault-form-group select,
.fault-form-group textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    background: #fff;
    color: var(--text);
    font-family: inherit;
    font-size: 13px;
    outline: none;
    box-sizing: border-box;
    transition: .2s;
}

.fault-form-group input[type="text"],
.fault-form-group input[type="date"],
.fault-form-group input[type="datetime-local"],
.fault-form-group select {
    height: 44px;
}

.fault-form-group select {
    cursor: pointer;
}

.fault-form-group textarea {
    min-height: 110px;
    resize: vertical;
    line-height: 1.6;
}

.fault-form-group input:focus,
.fault-form-group select:focus,
.fault-form-group textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
}

.fault-form-group input::placeholder,
.fault-form-group textarea::placeholder {
    color: var(--gray-400);
}

.fault-form-group .is-invalid {
    border-color: var(--danger) !important;
}

.fault-error {
    color: var(--danger);
    font-size: 12px;
}

/* ========================================
   FOOTER BUTTONS
======================================== */

.fault-create-footer {
    padding: 18px 24px;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
}

.fault-cancel-button,
.fault-save-button,
.fault-back-button {
    height: 42px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: .2s;
}

.fault-cancel-button,
.fault-back-button {
    border: 1px solid var(--gray-200);
    background: #fff;
    color: var(--gray-600);
}

.fault-cancel-button:hover,
.fault-back-button:hover {
    background: var(--gray-100);
}

.fault-save-button {
    border: 1px solid var(--primary);
    background: var(--primary);
    color: #fff;
}

.fault-save-button:hover {
    background: var(--primary-hover);
}

/* ========================================
   RESPONSIVE
======================================== */

@media(max-width: 768px) {

    .fault-create-page {
        width: 94%;
        margin: 20px auto;
    }

    .fault-create-header,
    .fault-create-body {
        padding: 18px;
    }

    .fault-create-footer {
        padding: 16px 18px;
        flex-wrap: wrap;
    }

    .fault-cancel-button,
    .fault-save-button {
        flex: 1;
    }

}

</style>

@endsection
