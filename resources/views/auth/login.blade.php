
@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')

    <div class="auth-page">

        <div class="auth-container">

            <div class="auth-card">

                <div class="auth-header">

                    <div class="auth-logo">
                        S
                    </div>

                    <h1>Giriş Yap</h1>

                    <p>
                        Hesabınıza giriş yaparak devam edin.
                    </p>

                </div>

                @if ($errors->any())
                    <div class="auth-alert auth-alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('loginForm') }}"
                    class="auth-form"
                >

                    @csrf

                    <div class="auth-form-group">

                        <label class="auth-form-label" for="email">
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

                    <div class="auth-form-group">

                        <label class="auth-form-label" for="password">
                            Şifre
                        </label>

                        <div class="auth-input-wrapper">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="auth-input auth-password-input"
                                placeholder="Şifrenizi girin"
                                required
                            >

                            <button
                                type="button"
                                class="auth-password-toggle"
                                onclick="togglePassword('password')"
                            >
                                Göster
                            </button>

                        </div>

                        @error('password')
                            <span class="auth-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="auth-form-options">

                        <label class="auth-remember">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                            >

                            Beni hatırla

                        </label>

                        <a
                            href="#"
                            class="auth-link"
                        >
                            Şifremi unuttum?
                        </a>

                    </div>

                    <button type="submit" class="auth-submit">
                        Giriş Yap
                    </button>

                </form>

                <div class="auth-divider">
                    veya
                </div>

                <div class="auth-footer">

                    Hesabınız yok mu?

                    <a href="{{ route('register') }}">
                        Kayıt Ol
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);

        input.type = input.type === 'password'
            ? 'text'
            : 'password';
    }
</script>
@endpush

