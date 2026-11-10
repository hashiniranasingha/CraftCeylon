@extends('layouts.app')

@section('title', 'Order Details - CraftCeylon')

@section('content')

<style>
    .order-details-page {
        background: #f7f8ef;
        min-height: 80vh;
        padding: 40px 0;
    }

    .details-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 22px;
        box-shadow: 0 4px 18px rgba(0,0,0,.05);
    }

    .details-heading {
        color: #245c3a;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .detail-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .detail-value {
        color: #263b2d;
        font-weight: 600;
        margin-bottom: 17px;
        overflow-wrap: anywhere;
    }

    .product-image {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border-radius: 10px;
        background: #f1f1f1;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fff0d5;
        color: #a56800;
    }

    .status-processing {
        background: #e2edff;
        color: #2457a6;
    }

    .status-completed,
    .status-delivered {
        background: #dff4e5;
        color: #237342;
    }

    .status-cancelled {
        background: #ffe1e1;
        color: #b52c2c;
    }

    .back-orders-btn {
        display: inline-block;
        background: #28633f;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .back-orders-btn:hover {
        background: #19492c;
        color: white;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 12px;
    }

    .summary-total {
        color: #245c3a;
        font-size: 20px;
        font-weight: 700;
        border-top: 1px solid #ddd;
        padding-top: 15px;
    }

    @media(max-width: 576px) {
        .details-card {
            padding: 17px;
        }

        .product-image {
            width: 60px;
            height: 60px;
        }
    }
</style>

<div class="order-details-page">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="details-heading mb-1">📦 Order Details</h2>

                <p class="text-muted mb-0">
                    Order #{{ $order->order_number }}
                </p>
            </div>

            <a href="{{ route('customer.orders.index') }}"
               class="back-orders-btn">
                ← Back to My Orders
            </a>

        </div>

        <!-- Order Information -->
        <div class="details-card">

            <h5 class="details-heading">Order Information</h5>

            <div class="row">

                <div class="col-md-4">
                    <div class="detail-label">Order Number</div>
                    <div class="detail-value">
                        {{ $order->order_number }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Order Date</div>
                    <div class="detail-value">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Payment Method</div>
                    <div class="detail-value">
                        {{ $order->payment_method }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Order Status</div>
                    <div class="detail-value">
                        <span class="status-badge status-{{ strtolower($order->order_status) }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="detail-label">Payment Status</div>
                    <div class="detail-value">
                        {{ ucfirst($order->payment_status) }}
                    </div>
                </div>

            </div>
        </div>

        <!-- Ordered Products -->
        <div class="details-card">

            <h5 class="details-heading">🛍️ Ordered Products</h5>

            @foreach($order->items as $item)

                <div class="d-flex align-items-center gap-3 py-3 border-bottom">

                    @if($item->product_image)
                        <img
                            src="{{ asset('storage/' . $item->product_image) }}"
                            alt="{{ $item->product_name }}"
                            class="product-image"
                        >
                    @else
                        <div class="product-image d-flex align-items-center justify-content-center">
                            🛍️
                        </div>
                    @endif

                    <div class="flex-grow-1">

                        <strong>{{ $item->product_name }}</strong>

                        <div class="text-muted small">
                            Rs. {{ number_format($item->price, 2) }}
                            × {{ $item->quantity }}
                        </div>

                    </div>

                    <strong>
                        Rs. {{ number_format($item->subtotal, 2) }}
                    </strong>

                </div>

            @endforeach

        </div>

        <div class="row">

            <!-- Shipping Information -->
            <div class="col-lg-7">

                <div class="details-card">

                    <h5 class="details-heading">🚚 Shipping Information</h5>

                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">
                        {{ $order->customer_name }}
                    </div>

                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">
                        {{ $order->customer_email }}
                    </div>

                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">
                        {{ $order->customer_phone }}
                    </div>

                    <div class="detail-label">City</div>
                    <div class="detail-value">
                        {{ $order->city }}
                    </div>

                    <div class="detail-label">Shipping Address</div>
                    <div class="detail-value">
                        {{ $order->shipping_address }}
                    </div>

                    @if($order->notes)
                        <div class="detail-label">Additional Notes</div>
                        <div class="detail-value">
                            {{ $order->notes }}
                        </div>
                    @endif

                </div>

            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">

                <div class="details-card">

                    <h5 class="details-heading">💰 Order Summary</h5>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <strong>
                            Rs. {{ number_format($order->subtotal, 2) }}
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Shipping Fee</span>
                        <strong>
                            Rs. {{ number_format($order->shipping_fee, 2) }}
                        </strong>
                    </div>

                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span>
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        <div class="mb-4">
            <a href="{{ route('customer.orders.index') }}"
               class="back-orders-btn">
                ← Back to My Orders
            </a>
        </div>

    </div>
</div>

@endsection
