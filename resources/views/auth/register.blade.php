@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="login-page-body">
    <div class="login-card">
        
        <div class="login-header">
            <a href="/" class="brand-logo">LuxeSpace</a>
            <h2>{{ __('انضم إلينا لتجربة تسوق استثنائية') }}</h2>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('الاسم بالكامل') }}</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user input-icon"></i>
                    <input id="name" type="text" class="form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="عبدالله محمد">
                </div>
                @error('name')
                    <span class="invalid-feedback-custom" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('البريد الإلكتروني') }}</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@domain.com">
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
                    <input id="password" type="password" class="form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                    <i class="fa-regular fa-eye-slash toggle-password" id="togglePasswordIcon" onclick="toggleVisibility('password', 'togglePasswordIcon')"></i>
                </div>
                @error('password')
                    <span class="invalid-feedback-custom" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('تأكيد كلمة المرور') }}</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-shield-halved input-icon"></i>
                    <input id="password-confirm" type="password" class="form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    <i class="fa-regular fa-eye-slash toggle-password" id="toggleConfirmPasswordIcon" onclick="toggleVisibility('password-confirm', 'toggleConfirmPasswordIcon')"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                {{ __('إنشاء الحساب') }}
            </button>

        </form>

        <div class="login-footer">
            <span>{{ __('لديك حساب بالفعل؟') }}</span>
            <a href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
            <br>
            <a href="/" class="back-to-store">
                <i class="fa-solid fa-arrow-right-to-bracket" style="transform: rotate(180deg);"></i> {{ __('العودة للمتجر') }}
            </a>
        </div>

    </div>
</div>

<script>
    function toggleVisibility(inputId, iconId) {
        const inputField = document.getElementById(inputId);
        const iconElement = document.getElementById(iconId);
        
        if (inputField.type === 'password') {
            inputField.type = 'text';
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        } else {
            inputField.type = 'password';
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        }
    }
</script>
@endsection