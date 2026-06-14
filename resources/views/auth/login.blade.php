@extends('layouts.app')

@section('content')

<div class="login-page-body">
    <div class="login-card">
        
        <div class="login-header">
            <a href="/" class="brand-logo">LuxeSpace</a>
            <h2>{{ __('مرحباً بك مجدداً في عالم الفخامة') }}</h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('البريد الإلكتروني') }}</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@domain.com">
                </div>
                @error('email')
                    <span class="invalid-feedback-custom" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('كلمة المرور') }}</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input id="password" type="password" class="form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <i class="fa-regular fa-eye-slash toggle-password" id="togglePasswordIcon" onclick="togglePasswordVisibility()"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback-custom" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>{{ __('تذكرني') }}</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="forgot-pass" href="{{ route('password.request') }}">
                        {{ __('نسيت كلمة المرور؟') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                {{ __('تسجيل الدخول') }}
            </button>

        </form>

        <div class="login-footer">
            <span>{{ __('ليس لديك حساب؟') }}</span>
            <a href="{{ route('register') }}">{{ __('أنشئ حسابك الآن') }}</a>
            <br>
            <a href="/" class="back-to-store">
                <i class="fa-solid fa-arrow-right-to-bracket" style="transform: rotate(180deg);"></i> {{ __('العودة للمتجر') }}
            </a>
        </div>

    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
@endsection