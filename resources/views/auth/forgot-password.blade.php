@extends('layouts.app')

@section('title', 'Şifremi Unuttum')

@section('content')

    <div class="auth-page">

        <div class="auth-container">

            <div class="auth-card auth-forgot-card">

                <div class="auth-header">

                    <div class="auth-logo">
                        S
                    </div>

                    <h1>Şifremi Unuttum</h1>

                    <p>
                        Şifrenizi sıfırlamak için e-posta adresinizi girin.
                    </p>

                </div>

                @if (session('status'))
                    <div class="auth-alert auth-alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-alert auth-alert-danger">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>
                @endif

                <div class="auth-info-box">

                    <span class="auth-info-icon">
                        i
                    </span>

                    <span>
                        E-posta adresinize şifre sıfırlama bağlantısı
                        göndereceğiz.
                    </span>

                </div>

                <form
                    method="POST"
                    class="auth-form"
                >

                    @csrf

                    <div class="auth-form-group">

                        <label
                            class="auth-form-label"
                            for="email"
                        >
                            E-posta
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="auth-input"
                            value="{{ old('email') }}"
                            placeholder="ornek@email.com"
                            required
                            autofocus
                        >

                        @error('email')
                            <span class="auth-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="auth-submit"
                    >
                        Şifre Sıfırlama Bağlantısı Gönder
                    </button>

                </form>

                <div class="auth-divider">
                    veya
                </div>

                <div class="auth-footer">

                    <a href="{{ route('login') }}">
                        ← Giriş sayfasına dön
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
