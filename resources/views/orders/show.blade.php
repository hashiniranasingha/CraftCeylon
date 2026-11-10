@extends('layouts.app')

@section('title', 'Order Details | CraftCeylon')

@push('styles')
<style>
    .order-details-page {
        background: #f8f7ef;
        min-height: 75vh;
        padding: 40px 0 60px;
    }

    .details-header {
        background: linear-gradient(135deg, #174d35, #2e7950);
        color: white;
        padding: 28px;
        border-radius: 18px;
        margin-bottom: 25px;
    }

    .details-header h2 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .details-header p {
        color: #e3eee5;
        margin: 0;
    }

    .details-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 22px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
    }

    .details-card h5 {
        color: #205b3c;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .product-image {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        background: #f2f2ed;
    }

    .product-name {
        color: #24583b;
        font-weight: 700;
    }

    .detail-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #263d2e;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fff1d6;
        color: #9a6500;
    }

    .status-processing {
        background: #e1efff;
        color: #185a9d;
    }

    .status-completed,
    .status-delivered {
        background: #dcf5e5;
        color: #17683a;
    }

    .status-cancelled {
        background: #ffe1e1;
        color: #a52a2a;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 13px;
        color: #555;
    }

    .summary-total {
        border-top: 1px solid #e8eee8;
        padding-top: 15px;
        color: #1e6844;
        font-size: 19px;
        font-weight: 800;
    }

    .back-btn {
        display: inline-block;
        background: #1e6844;
        color: white;
        padding: 11px 20px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
    }

    .back-btn:hover {
        background: #174d35;
        color: white;
    }

    @media (max-width: 576px) {
        .order-details-page {
            padding: 25px 0 40px;
        }

        .details-header {
            padding: 22px 18px;
        }

        .details-card {
            padding: 18px;
        }

        .product-image {
            width: 55px;
            height: 55px;
        }
    }
</style>
@endpush

@section('content')
<div class="order-details-page">
    <div class="container">

        <div class="details-header">
            <h2>📦 Order Details</h2>
            <p>
                Order #{{ $order->order_number }}
                &nbsp; | &nbsp;
                Placed on {{ $order->created_at->format('d M Y, h:i A') }}
            </p>
        </div>

        {{-- Order Status --}}
        <div class="details-card">
            <h5>📋 Order Information</h5>

            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="detail-label">Order Status</div>
                    @php
                        $orderStatus = strtolower($order->order_status ?? 'pending');
                    @endphp
                    <span class="status-badge status-{{ $orderStatus }}">
                        {{ ucfirst($orderStatus) }}
                    </span>
                </div>

                <div class="col-md-3 col-6">
                    <div class="detail-label">Payment Method</div>
                    <div class="detail-value">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="detail-label">Payment Status</div>
                    <div class="detail-value">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'pending')) }}
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="detail-label">Order Number</div>
                    <div class="detail-value">
                        {{ $order->order_number }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Products --}}
        <div class="details-card">
            <h5>🛍️ Ordered Products</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
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

                                        <span class="product-name">
                                            {{ $item->product_name }}
                                        </span>
                                    </div>
                                </td>

                                <td>Rs. {{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>

                                <td class="text-end fw-bold">
                                    Rs. {{ number_format($item->subtotal, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Shipping Address --}}
        <div class="details-card">
            <h5>🚚 Shipping Information</h5>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">{{ $order->customer_name }}</div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">{{ $order->customer_email }}</div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">Phone Number</div>
                    <div class="detail-value">{{ $order->customer_phone }}</div>
                </div>

                <div class="col-md-6">
                    <div class="detail-label">City</div>
                    <div class="detail-value">{{ $order->city }}</div>
                </div>

                <div class="col-12">
                    <div class="detail-label">Shipping Address</div>
                    <div class="detail-value">{{ $order->shipping_address }}</div>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="details-card">
            <h5>💰 Order Summary</h5>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rs. {{ number_format($order->subtotal, 2) }}</span>
            </div>

            <div class="summary-row">
                <span>Shipping Fee</span>
                <span>Rs. {{ number_format($order->shipping_fee, 2) }}</span>
            </div>

            <div class="summary-row summary-total">
                <span>Total Amount</span>
                <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>

        @if($order->notes)
            <div class="details-card">
                <h5>📝 Additional Notes</h5>
                <p class="mb-0">{{ $order->notes }}</p>
            </div>
        @endif

        <a href="{{ route('customer.orders.index') }}" class="back-btn">
            ← Back to My Orders
        </a>

    </div>
</div>
@endsection
