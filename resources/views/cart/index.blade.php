@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold">Shopping Cart</h2>
        <p class="text-muted">Review your selected handmade crafts.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if($cart->items->isEmpty())

        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <div class="mb-3">
                    <i class="bi bi-cart3 text-muted" style="font-size: 55px;"></i>
                </div>

                <h4 class="fw-bold">Your Cart is Empty</h4>

                <p class="text-muted">
                    You haven't added any products to your shopping cart yet.
                </p>

                <a href="{{ route('home') }}" class="btn btn-success px-4">
                    Continue Shopping
                </a>
            </div>
        </div>

    @else

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table align-middle">

                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($cart->items as $item)

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">

                                                    @if($item->product && $item->product->image)
                                                        <img
                                                            src="{{ asset('storage/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}"
                                                            width="65"
                                                            height="65"
                                                            class="rounded"
                                                            style="object-fit: cover;"
                                                        >
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                             style="width:65px;height:65px;">
                                                            <i class="bi bi-image text-muted fs-4"></i>
                                                        </div>
                                                    @endif

                                                    <div>
                                                        <div class="fw-semibold">
                                                            {{ $item->product->name ?? 'Product unavailable' }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>

                                            <td>
                                                Rs. {{ number_format($item->price, 2) }}
                                            </td>

                                            <td>
                                                @if($item->product)
                                                    <form action="{{ route('cart.update', $item->id) }}"
                                                          method="POST"
                                                          class="d-flex gap-2">

                                                        @csrf
                                                        @method('PATCH')

                                                        <input
                                                            type="number"
                                                            name="quantity"
                                                            value="{{ $item->quantity }}"
                                                            min="1"
                                                            max="{{ $item->product->stock }}"
                                                            class="form-control form-control-sm"
                                                            style="width:75px;"
                                                            required
                                                        >

                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-success">
                                                            Update
                                                        </button>

                                                    </form>
                                                @else
                                                    <span class="text-muted">Unavailable</span>
                                                @endif
                                            </td>

                                            <td class="fw-semibold">
                                                Rs. {{ number_format($item->price * $item->quantity, 2) }}
                                            </td>

                                            <td>
                                                <form action="{{ route('cart.remove', $item->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Remove this product from your cart?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">
                                                        Remove
                                                    </button>

                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">Cart Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">
                                Rs. {{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping Fee</span>
                            <span class="text-success">Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-success fs-5">
                                Rs. {{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-success w-100 py-2">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('home') }}"
                           class="btn btn-outline-secondary w-100 mt-2">
                            Continue Shopping
                        </a>

                    </div>
                </div>

            </div>

        </div>

    @endif

</div>
@endsection
