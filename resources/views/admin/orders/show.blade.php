@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order Details</h2>
            <p class="text-muted mb-0">
                Order Number: {{ $order->order_number }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-outline-secondary">
            Back to Orders
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Ordered Products</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product_image)
                                                    <img
                                                        src="{{ asset('storage/' . $item->product_image) }}"
                                                        width="55"
                                                        height="55"
                                                        class="rounded"
                                                        style="object-fit: cover;"
                                                        alt="{{ $item->product_name }}"
                                                    >
                                                @endif

                                                <div>
                                                    <div class="fw-semibold">
                                                        {{ $item->product_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            Rs. {{ number_format($item->price, 2) }}
                                        </td>

                                        <td>{{ $item->quantity }}</td>

                                        <td class="fw-semibold">
                                            Rs. {{ number_format($item->subtotal, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            No products found in this order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($order->subtotal, 2) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping Fee</span>
                                <span>Rs. {{ number_format($order->shipping_fee, 2) }}</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total</span>
                                <span class="text-success">
                                    Rs. {{ number_format($order->total_amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Customer Information</h5>
                </div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>City:</strong> {{ $order->city }}</p>

                    @if($order->notes)
                        <p class="mb-0">
                            <strong>Order Notes:</strong> {{ $order->notes }}
                        </p>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Order Summary</h5>
                </div>

                <div class="card-body">
                    <p>
                        <strong>Order Number:</strong><br>
                        {{ $order->order_number }}
                    </p>

                    <p>
                        <strong>Order Date:</strong><br>
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>

                    <p>
                        <strong>Payment Method:</strong><br>
                        {{ $order->payment_method }}
                    </p>

                    <p class="mb-0">
                        <strong>Current Order Status:</strong><br>
                        {{ $order->order_status }}
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Update Order</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.orders.update', $order) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Order Status
                            </label>

                            <select name="order_status" class="form-select" required>
                                @foreach(['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $order->order_status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Payment Status
                            </label>

                            <select name="payment_status" class="form-select" required>
                                @foreach(['Pending', 'Paid', 'Failed'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $order->payment_status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <button type="submit" class="btn btn-success w-100">
                            Update Order
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
