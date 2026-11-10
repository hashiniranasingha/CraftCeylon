@extends('layouts.app')

@section('title', 'My Orders - CraftCeylon')

@section('content')

<style>
    .orders-page {
        background: #f7f8ef;
        min-height: 80vh;
        padding: 45px 0;
    }

    .orders-card {
        background: #fff;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
    }

    .orders-heading {
        color: #245c3a;
        font-weight: 700;
    }

    .orders-table th {
        background: #e8f0e5;
        color: #245c3a;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
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

    .view-order-btn {
        background: #28633f;
        color: white;
        border-radius: 8px;
        padding: 7px 13px;
        text-decoration: none;
        display: inline-block;
        font-size: 13px;
    }

    .view-order-btn:hover {
        background: #19492c;
        color: white;
    }

    .back-btn {
        color: #28633f;
        text-decoration: none;
        font-weight: 600;
    }

    @media(max-width: 768px) {
        .orders-card {
            padding: 16px;
        }
    }
</style>

<div class="orders-page">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h2 class="orders-heading">📦 My Orders</h2>
                <p class="text-muted mb-0">View your order history and details.</p>
            </div>

            <a href="{{ route('customer.dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>
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
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <strong>{{ $order->order_number }}</strong>
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $order->items->sum('quantity') }}
                                    </td>

                                    <td>
                                        Rs. {{ number_format($order->total_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ ucfirst($order->payment_status) }}
                                    </td>

                                    <td>
                                        <span class="status-badge status-{{ strtolower($order->order_status) }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                           class="view-order-btn">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>

            @else

                <div class="text-center py-5">
                    <div style="font-size: 55px;">🛍️</div>

                    <h4 class="orders-heading mt-3">No Orders Yet</h4>

                    <p class="text-muted">
                        You haven't placed any orders yet.
                    </p>

                    <a href="{{ route('products.index') }}"
                       class="view-order-btn mt-2">
                        Explore Products
                    </a>
                </div>

            @endif

        </div>
    </div>
</div>

@endsection
