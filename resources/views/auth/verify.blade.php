@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="login-page-body">
    <div class="login-card" style="text-align: center;">
        
        <div class="login-header">
            <a href="/" class="brand-logo">LuxeSpace</a>
            
            <h2>{{ __('الرجاء تاكيد حسابك') }}</h2>
        </div>

        @if (session('resent'))
            <div style="background-color: #e2ebd5; color: #4b6b2a; padding: 12px; border-radius: 12px; font-size: 14px; margin-bottom: 20px; font-weight: 500;">
                {{ __('تم إرسال رابط تأكيد جديد إلى بريدك الإلكتروني بنجاح.') }}
            </div>
        @endif

        <div style="margin-bottom: 30px; color: #606060; font-size: 14px; line-height: 1.8;">
            <p>
                {{ __('قبل المتابعة، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التأكيد الخاص بك.') }}
            </p>
            <p style="margin-top: 10px;">
                {{ __('إذا لم تستلم البريد الإلكتروني حتى الآن، لا تقلق، يمكنك طلب رابط آخر.') }}
            </p>
        </div>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-login" style="border: none; cursor: pointer; width: 100%;">
                {{ __('إرسال رابط تأكيد جديد') }}
            </button>
        </form>

        <div class="login-footer" style="margin-top: 25px; font-size: 13px; color: #707070;">
            <a href="/" class="back-to-store">
                <i class="fa-solid fa-arrow-right-to-bracket" style="transform: rotate(180deg);"></i> {{ __('العودة للمتجر الرئيسي') }}
            </a>
        </div>

    </div>
</div>
@endsection