@extends('layouts.app')

@section('content')

<style>
    .confirmation-page {
        background: #f8f6ef;
        min-height: 80vh;
        padding: 65px 15px;
    }

    .confirmation-card {
        max-width: 750px;
        margin: auto;
        background: #ffffff;
        padding: 45px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }

    .success-icon {
        width: 85px;
        height: 85px;
        background: #e5f2e8;
        color: #285b3e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        margin: 0 auto 25px;
    }

    .confirmation-card h1 {
        color: #234b36;
        font-family: Georgia, serif;
        margin-bottom: 15px;
    }

    .order-number {
        background: #f5f3eb;
        padding: 16px;
        border-radius: 8px;
        margin: 25px 0;
    }

    .order-info {
        text-align: left;
        border-top: 1px solid #e8e5dc;
        padding-top: 20px;
        margin-top: 25px;
    }

    .order-info p {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 14px;
    }

    .order-info strong {
        color: #234b36;
    }

    .continue-btn {
        display: inline-block;
        background: #285b3e;
        color: white;
        padding: 13px 28px;
        border-radius: 6px;
        text-decoration: none;
        margin-top: 25px;
    }

    .continue-btn:hover {
        background: #1b402b;
        color: white;
    }

    @media(max-width: 576px) {
        .confirmation-card {
            padding: 25px 18px;
        }
    }
</style>

<div class="confirmation-page">
    <div class="confirmation-card">

        <div class="success-icon">✓</div>

        <h1>Thank You for Your Order!</h1>

        <p class="text-muted">
            Your order has been placed successfully.
            We appreciate your support for Sri Lankan handmade crafts.
        </p>

        <div class="order-number">
            <small class="text-muted">Your Order Number</small>
            <h4 class="mb-0">
                {{ $order->order_number }}
            </h4>
        </div>

        <div class="order-info">

            <h5 class="mb-3">Order Details</h5>

            <p>
                <span>Customer Name</span>
                <strong>{{ $order->customer_name }}</strong>
            </p>

            <p>
                <span>Email</span>
                <strong>{{ $order->customer_email }}</strong>
            </p>

            <p>
                <span>Phone</span>
                <strong>{{ $order->customer_phone }}</strong>
            </p>

            <p>
                <span>Delivery City</span>
                <strong>{{ $order->city }}</strong>
            </p>

            <p>
                <span>Payment Method</span>
                <strong>{{ $order->payment_method }}</strong>
            </p>

            <p>
                <span>Payment Status</span>
                <strong>{{ $order->payment_status }}</strong>
            </p>

            <p>
                <span>Order Status</span>
                <strong>{{ $order->order_status }}</strong>
            </p>

            <p>
                <span>Total Amount</span>
                <strong>
                    Rs. {{ number_format($order->total_amount, 2) }}
                </strong>
            </p>

        </div>

        <a href="{{ route('products.index') }}" class="continue-btn">
            Continue Shopping
        </a>

    </div>
</div>

@endsection
