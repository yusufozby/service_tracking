@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')

    <div class="auth-page">

        <div class="auth-container">

            <div class="auth-card auth-register-card">

                <div class="auth-header">

                    <div class="auth-logo">
                        S
                    </div>

                    <h1>Kayıt Ol</h1>

                    <p>
                        Yeni hesabınızı oluşturun.
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
                    action="{{ route('create-user') }}"
                    class="auth-register-form"
                >

                    @csrf
                  <div class="auth-form-group">

                            <label
                                class="auth-form-label"
                                for="name"
                            >
                                Ad Soyad
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="auth-input"
                                value="{{ old('name') }}"
                                placeholder="Ad Soyad"
                                required
                                autofocus
                            >

                            @error('name')
                                <span class="auth-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>



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
                        >

                        @error('email')
                            <span class="auth-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="auth-form-group">

                        <label
                            class="auth-form-label"
                            for="password"
                        >
                            Şifre
                        </label>

                        <div class="auth-input-wrapper">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="auth-input auth-password-input"
                                placeholder="Şifrenizi oluşturun"
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

                    <div class="auth-form-group">

                        <label
                            class="auth-form-label"
                            for="password_confirmation"
                        >
                            Şifre Tekrar
                        </label>

                        <div class="auth-input-wrapper">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="auth-input auth-password-input"
                                placeholder="Şifrenizi tekrar girin"
                                required
                            >

                            <button
                                type="button"
                                class="auth-password-toggle"
                                onclick="togglePassword('password_confirmation')"
                            >
                                Göster
                            </button>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="auth-submit"
                    >
                        Kayıt Ol
                    </button>

                </form>
                   <div class="auth-divider">
                    veya
                </div>
                  <div class="auth-footer">

                    Zaten hesabınız var mı?

                    <a href="{{ route('login') }}">
                        Giriş Yap
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

