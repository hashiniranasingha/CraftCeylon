@extends('layouts.app')

@section('title', 'Order Management')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order Management</h2>
            <p class="text-muted mb-0">Manage customer orders and track their status.</p>
        </div>
        <span class="badge bg-success fs-6">
            Total Orders: {{ $orders->total() }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $order->order_number }}
                                </td>

                                <td>
                                    {{ $order->customer_name }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $order->customer_email }}
                                    </small>
                                </td>

                                <td>
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                                <td class="fw-semibold">
                                    Rs. {{ number_format($order->total_amount, 2) }}
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>

                                <td>
                                    @php
                                        $statusColors = [
                                            'Pending' => 'warning',
                                            'Processing' => 'info',
                                            'Shipped' => 'primary',
                                            'Delivered' => 'success',
                                            'Cancelled' => 'danger',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-success">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <h5 class="text-muted">No Orders Found</h5>
                                    <p class="text-muted mb-0">
                                        Customer orders will appear here.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
