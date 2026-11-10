@extends('layouts.app')

@section('title', 'Login | CraftCeylon')

@push('styles')
<style>
    .login-page {
        min-height: 80vh;
        padding: 65px 15px;
        background:
            radial-gradient(circle at top left, #dcefe0 0, transparent 38%),
            radial-gradient(circle at bottom right, #f6e8c9 0, transparent 35%),
            #f7f8f1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        max-width: 460px;
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(24, 69, 43, .13);
        border: 1px solid #e6eee5;
    }

    .login-header {
        background: linear-gradient(135deg, #174a32, #398052);
        color: white;
        text-align: center;
        padding: 38px 25px 32px;
    }

    .login-logo {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: #f5d99b;
    }

    .login-header h2 {
        font-size: 27px;
        font-weight: 750;
        margin-bottom: 8px;
    }

    .login-header p {
        color: #e1eee5;
        margin: 0;
        font-size: 14px;
    }

    .login-body {
        padding: 35px;
    }

    .login-label {
        color: #254b35;
        font-size: 14px;
        font-weight: 650;
        margin-bottom: 9px;
    }

    .login-input {
        min-height: 49px;
        border: 1px solid #dce7dd;
        border-radius: 10px;
        padding: 11px 14px;
        background: #fbfdfb;
        color: #244632;
        transition: .25s;
    }

    .login-input:focus {
        border-color: #398052;
        box-shadow: 0 0 0 3px rgba(57, 128, 82, .12);
        background: #fff;
    }

    .login-input::placeholder {
        color: #a0ada3;
    }

    .login-remember {
        color: #64766a;
        font-size: 14px;
    }

    .login-remember .form-check-input:checked {
        background-color: #287047;
        border-color: #287047;
    }

    .login-button {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 13px;
        margin-top: 10px;
        background: linear-gradient(135deg, #20583c, #398052);
        color: white;
        font-size: 16px;
        font-weight: 700;
        transition: .3s;
    }

    .login-button:hover {
        background: linear-gradient(135deg, #153d29, #286b43);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(32, 88, 60, .2);
    }

    .login-register {
        text-align: center;
        margin-top: 25px;
        color: #748078;
        font-size: 14px;
    }

    .login-register a {
        color: #287047;
        font-weight: 700;
        text-decoration: none;
    }

    .login-register a:hover {
        color: #153d29;
        text-decoration: underline;
    }

    .login-alert {
        border-radius: 10px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .login-page {
            padding: 35px 12px;
        }

        .login-body {
            padding: 25px 20px;
        }

        .login-header {
            padding: 30px 20px;
        }
    }
</style>
@endpush

@section('content')

<div class="login-page">

    <div class="login-card">

        <div class="login-header">
           <div class="login-logo">
    <span style="font-size: 32px;">🌿</span>
</div>

            <h2>Welcome Back!</h2>

            <p>Discover the beauty of Sri Lankan handmade crafts.</p>
        </div>

        <div class="login-body">

            @if(session('success'))
                <div class="alert alert-success login-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger login-alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label login-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control login-input"
                        value="{{ old('email') }}"
                        placeholder="Enter your email address"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label login-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control login-input"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <div class="mb-3 form-check login-remember">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="form-check-input"
                    >

                    <label for="remember" class="form-check-label">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="login-button">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login to Your Account
                </button>

            </form>

            <div class="login-register">
                Don't have an account?
                <a href="{{ route('register') }}">Create an Account</a>
            </div>

        </div>

    </div>

</div>

@endsection
