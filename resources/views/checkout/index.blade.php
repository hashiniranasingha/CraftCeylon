@extends('layouts.app')

@section('content')

<style>
    .checkout-page {
        background: #f8f7f2;
        min-height: 100vh;
        padding: 55px 0 80px;
        color: #263b30;
    }

    .checkout-container {
        max-width: 1180px;
        margin: auto;
        padding: 0 20px;
    }

    .checkout-heading {
        margin-bottom: 35px;
    }

    .checkout-heading small {
        color: #a17b43;
        letter-spacing: 3px;
        font-size: 11px;
        font-weight: 700;
    }

    .checkout-heading h1 {
        font-family: Georgia, serif;
        font-size: 42px;
        margin: 12px 0;
        color: #234334;
    }

    .checkout-heading p {
        color: #777;
        font-size: 14px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.55fr 0.9fr;
        gap: 30px;
        align-items: start;
    }

    .checkout-card {
        background: #fff;
        border: 1px solid #e9e6dc;
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 8px 30px rgba(35, 67, 52, 0.04);
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
    }

    .section-number {
        width: 34px;
        height: 34px;
        background: #234334;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .section-heading h2 {
        font-family: Georgia, serif;
        font-size: 22px;
        margin: 0;
        color: #234334;
    }

    .form-label {
        color: #394d40;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e2e1d9;
        border-radius: 7px;
        padding: 12px 14px;
        font-size: 14px;
        background: #fdfdfb;
    }

    .form-control:focus {
        border-color: #567b62;
        box-shadow: 0 0 0 3px rgba(86, 123, 98, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .order-card {
        position: sticky;
        top: 25px;
    }

    .order-card h2 {
        font-family: Georgia, serif;
        font-size: 25px;
        color: #234334;
        margin-bottom: 25px;
    }

    .order-product {
        display: flex;
        gap: 14px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .order-product img {
        width: 68px;
        height: 68px;
        object-fit: cover;
        border-radius: 7px;
        background: #f3f1e9;
    }

    .product-details {
        flex: 1;
    }

    .product-details h4 {
        font-size: 14px;
        font-weight: 600;
        color: #34483a;
        margin: 4px 0 7px;
    }

    .product-details p {
        color: #888;
        font-size: 12px;
        margin: 0;
    }

    .product-price {
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin: 18px 0;
        font-size: 14px;
        color: #777;
    }

    .summary-total {
        border-top: 1px solid #e9e6dc;
        padding-top: 20px;
        margin-top: 20px;
        color: #234334;
        font-size: 18px;
        font-weight: 700;
    }

    .payment-box {
        background: #f6f8f3;
        border: 1px solid #dce7d9;
        border-radius: 9px;
        padding: 18px;
    }

    .payment-box strong {
        display: block;
        color: #234334;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .payment-box p {
        font-size: 12px;
        color: #777;
        margin: 0;
    }

    .place-order-btn {
        display: block;
        width: 100%;
        background: #234334;
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 7px;
        font-weight: 600;
        margin-top: 24px;
        transition: 0.3s;
    }

    .place-order-btn:hover {
        background: #365c45;
        color: #fff;
    }

    .secure-note {
        text-align: center;
        color: #888;
        font-size: 11px;
        margin-top: 15px;
    }

    .back-link {
        display: inline-block;
        color: #567b62;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 25px;
    }

    .back-link:hover {
        color: #234334;
    }

    @media (max-width: 850px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .order-card {
            position: static;
        }

        .checkout-heading h1 {
            font-size: 34px;
        }
    }

    @media (max-width: 500px) {
        .checkout-card {
            padding: 22px 17px;
        }

        .checkout-page {
            padding-top: 30px;
        }
    }
</style>

<div class="checkout-page">
    <div class="checkout-container">

        <a href="{{ route('cart.index') }}" class="back-link">
            ← Back to Shopping Cart
        </a>

        <div class="checkout-heading">
            <small>CRAFTCEYLON / CHECKOUT</small>
            <h1>Complete Your Order</h1>
            <p>You're one step away from bringing authentic Sri Lankan craftsmanship home.</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please check the following details:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf

            <div class="checkout-grid">

                <div>

                    <div class="checkout-card">

                        <div class="section-heading">
                            <div class="section-number">1</div>
                            <h2>Customer Information</h2>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input
                                type="text"
                                name="customer_name"
                                class="form-control"
                                placeholder="Enter your full name"
                                value="{{ old('customer_name', auth()->user()->name) }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input
                                type="email"
                                name="customer_email"
                                class="form-control"
                                placeholder="example@email.com"
                                value="{{ old('customer_email', auth()->user()->email) }}"
                                required>
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label">Phone Number *</label>
                            <input
                                type="tel"
                                name="customer_phone"
                                class="form-control"
                                placeholder="07XXXXXXXX"
                                value="{{ old('customer_phone') }}"
                                required>
                        </div>

                    </div>

                    <div class="checkout-card">

                        <div class="section-heading">
                            <div class="section-number">2</div>
                            <h2>Delivery Information</h2>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Address *</label>
                            <textarea
                                name="shipping_address"
                                class="form-control"
                                rows="3"
                                placeholder="House number, street and area"
                                required>{{ old('shipping_address') }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label">City *</label>
                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                placeholder="Enter your city"
                                value="{{ old('city') }}"
                                required>
                        </div>

                    </div>

                    <div class="checkout-card">

                        <div class="section-heading">
                            <div class="section-number">3</div>
                            <h2>Payment Method</h2>
                        </div>

                        <div class="payment-box">
                            <strong>Cash on Delivery</strong>
                            <p>Pay for your order when it is delivered to your doorstep.</p>
                        </div>

                        <div class="form-group mt-4 mb-0">
                            <label class="form-label">Order Notes (Optional)</label>
                            <textarea
                                name="notes"
                                class="form-control"
                                rows="3"
                                placeholder="Any special instructions for your order?">{{ old('notes') }}</textarea>
                        </div>

                    </div>

                </div>

                <div>

                    <div class="checkout-card order-card">

                        <h2>Your Order</h2>

                        @foreach($cart->items as $item)

                            <div class="order-product">

                                @if($item->product && $item->product->image)
                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}">
                                @else
                                    <img
                                        src="https://placehold.co/100x100/f3f1e9/234334?text=Craft"
                                        alt="Craft product">
                                @endif

                                <div class="product-details">
                                    <h4>{{ $item->product->name }}</h4>
                                    <p>Quantity: {{ $item->quantity }}</p>
                                </div>

                                <div class="product-price">
                                    Rs. {{ number_format($item->price * $item->quantity, 2) }}
                                </div>

                            </div>

                        @endforeach

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>

                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span>Rs. {{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="place-order-btn">
                            Place Order →
                        </button>

                        <p class="secure-note">
                            Your order details are securely processed.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection
