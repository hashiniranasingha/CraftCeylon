@extends('layouts.app')

@section('title', 'Create Account | CraftCeylon')

@push('styles')
<style>
    .register-page {
        min-height: 80vh;
        padding: 60px 15px;
        background:
            radial-gradient(circle at top left, #dcefe0 0, transparent 38%),
            radial-gradient(circle at bottom right, #f6e8c9 0, transparent 35%),
            #f7f8f1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        width: 100%;
        max-width: 520px;
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(24, 69, 43, .13);
        border: 1px solid #e6eee5;
    }

    .register-header {
        background: linear-gradient(135deg, #174a32, #398052);
        color: white;
        text-align: center;
        padding: 32px 25px;
    }

    .register-logo {
        width: 62px;
        height: 62px;
        margin: 0 auto 13px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .register-header h2 {
        font-size: 27px;
        font-weight: 750;
        margin-bottom: 8px;
    }

    .register-header p {
        color: #e1eee5;
        margin: 0;
        font-size: 14px;
    }

    .register-body {
        padding: 32px 38px;
    }

    .register-label {
        color: #254b35;
        font-size: 14px;
        font-weight: 650;
        margin-bottom: 8px;
    }

    .register-input {
        min-height: 47px;
        border: 1px solid #dce7dd;
        border-radius: 10px;
        padding: 10px 14px;
        background: #fbfdfb;
        color: #244632;
        transition: .25s;
    }

    .register-input:focus {
        border-color: #398052;
        box-shadow: 0 0 0 3px rgba(57, 128, 82, .12);
        background: #fff;
    }

    .register-input::placeholder {
        color: #a0ada3;
    }

    .register-button {
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

    .register-button:hover {
        background: linear-gradient(135deg, #153d29, #286b43);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(32, 88, 60, .2);
    }

    .register-login {
        text-align: center;
        margin-top: 23px;
        color: #748078;
        font-size: 14px;
    }

    .register-login a {
        color: #287047;
        font-weight: 700;
        text-decoration: none;
    }

    .register-login a:hover {
        color: #153d29;
        text-decoration: underline;
    }

    .register-alert {
        border-radius: 10px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .register-page {
            padding: 35px 12px;
        }

        .register-body {
            padding: 25px 20px;
        }

        .register-header {
            padding: 28px 20px;
        }
    }
</style>
@endpush

@section('content')

<div class="register-page">

    <div class="register-card">

        <div class="register-header">

            <div class="register-logo">
                <span>🌿</span>
            </div>

            <h2>Create Your Account</h2>

            <p>Join CraftCeylon and discover beautiful Sri Lankan handmade crafts.</p>

        </div>

        <div class="register-body">

            @if($errors->any())
                <div class="alert alert-danger register-alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label register-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control register-input"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label register-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control register-input"
                        value="{{ old('email') }}"
                        placeholder="Enter your email address"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label register-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control register-input"
                        placeholder="Create a password"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label register-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control register-input"
                        placeholder="Confirm your password"
                        required
                    >
                </div>

                <button type="submit" class="register-button">
                    ✨ Create My Account
                </button>

            </form>

            <div class="register-login">
                Already have an account?
                <a href="{{ route('login') }}">Login Here</a>
            </div>

        </div>

    </div>

</div>

@endsection
