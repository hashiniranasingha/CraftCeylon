@extends('layouts.app')

@section('title', 'My Orders | CraftCeylon')

@push('styles')
<style>
    .orders-page {
        background: #f8f7ef;
        min-height: 75vh;
        padding: 45px 0 65px;
    }

    .orders-header {
        background: linear-gradient(135deg, #174d35, #2e7950);
        color: white;
        padding: 30px;
        border-radius: 18px;
        margin-bottom: 30px;
        box-shadow: 0 8px 22px rgba(23, 77, 53, .13);
    }

    .orders-header h2 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .orders-header p {
        margin: 0;
        color: #e3eee5;
    }

    .orders-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
    }

    .orders-table th {
        color: #496452;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #e8eee8;
        white-space: nowrap;
    }

    .orders-table td {
        padding-top: 18px;
        padding-bottom: 18px;
        vertical-align: middle;
    }

    .order-number {
        color: #1d633f;
        font-weight: 700;
        text-decoration: none;
    }

    .order-number:hover {
        color: #b38b3d;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 12px;
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

    .view-order-btn {
        background: #1e6844;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 14px;
        text-decoration: none;
        font-size: 13px;
        display: inline-block;
    }

    .view-order-btn:hover {
        background: #174d35;
        color: white;
    }

    .empty-orders {
        text-align: center;
        padding: 55px 15px;
    }

    .empty-orders .empty-icon {
        font-size: 55px;
        margin-bottom: 15px;
    }

    .empty-orders h4 {
        color: #24583b;
        font-weight: 700;
    }

    .empty-orders p {
        color: #777;
    }

    .shop-btn {
        display: inline-block;
        background: #1e6844;
        color: white;
        padding: 11px 22px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
    }

    .shop-btn:hover {
        background: #174d35;
        color: white;
    }

    @media (max-width: 576px) {
        .orders-page {
            padding: 25px 0 40px;
        }

        .orders-header {
            padding: 23px 20px;
        }

        .orders-card {
            padding: 15px;
        }

        .orders-table {
            min-width: 700px;
        }
    }
</style>
@endpush

@section('content')
<div class="orders-page">
    <div class="container">

        <div class="orders-header">
            <h2>📦 My Order History</h2>
            <p>View and track all your CraftCeylon purchases in one place.</p>
        </div>

        <div class="orders-card">

            @if($orders->count() > 0)

                <div class="table-responsive">
                    <table class="table orders-table align-middle">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Payment</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                           class="order-number">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $order->items()->sum('quantity') }}
                                    </td>

                                    <td class="fw-bold">
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'pending')) }}
                                    </td>

                                    <td>
                                        @php
                                            $status = strtolower($order->order_status ?? 'pending');
                                        @endphp

                                        <span class="status-badge status-{{ $status }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                           class="view-order-btn">
                                            View Details →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>

            @else

                <div class="empty-orders">
                    <div class="empty-icon">🛍️</div>
                    <h4>No Orders Yet!</h4>
                    <p>You haven't placed any orders. Explore our handmade Sri Lankan crafts.</p>

                    <a href="{{ route('products.index') }}" class="shop-btn">
                        Explore Products
                    </a>
                </div>

            @endif

        </div>

        <div class="mt-4">
            <a href="{{ route('customer.dashboard') }}"
               class="text-decoration-none fw-semibold"
               style="color: #1e6844;">
                ← Back to My Dashboard
            </a>
        </div>

    </div>
</div>
@endsection
