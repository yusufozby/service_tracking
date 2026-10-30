@extends('layouts.app')

@section('content')



    <div class="min-vh-100 d-flex align-items-center justify-content-center px-3 py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4 p-sm-5" style="max-width: 420px; width: 100%;">

            {{-- İkon --}}
            <div class="d-flex justify-content-center mb-4">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10"
                    style="width: 56px; height: 56px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="text-primary" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
                    </svg>
                </div>
            </div>

            {{-- Başlık --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark mb-2">
                    İki Faktörlü Doğrulama
                </h2>
                <p class="text-muted small mb-0">
                    E-posta adresinize gönderilen 6 haneli doğrulama kodunu girin.
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('verify-form') }}">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label text-center d-block fw-medium">
                        Doğrulama Kodu
                    </label>

                    <input type="text" id="code" name="code" maxlength="6" inputmode="numeric"
                        autocomplete="one-time-code" placeholder="••••••" required autofocus
                        class="form-control form-control-lg text-center fw-semibold @error('code') is-invalid @enderror"
                        style="letter-spacing: 0.5em; font-size: 1.5rem;">

                    @error('code')
                        <div class="invalid-feedback text-center d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold mt-2">
                    Doğrula
                </button>
            </form>

            <p class="text-center text-muted small mt-4 mb-0">
                Kodunuzun süresi sınırlıdır. Lütfen size gönderilen kodu kullanın.
            </p>

        </div>
    </div>
@endsection



