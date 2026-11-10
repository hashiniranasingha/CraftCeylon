@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
           class="text-decoration-none text-muted">
            ← Back to Products
        </a>

        <h2 class="fw-bold mt-3 mb-1">Product Details</h2>
        <p class="text-muted">View complete product information.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <div class="row">

                <div class="col-md-4 mb-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="img-fluid rounded border"
                             style="width:100%; max-height:350px; object-fit:cover;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                             style="height:300px;">
                            <span class="text-muted">No Product Image</span>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="fw-bold">{{ $product->name }}</h3>
                            <p class="text-muted">
                                Category: {{ $product->category->name ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            @if($product->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif

                            @if($product->is_featured)
                                <span class="badge bg-warning text-dark">Featured</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row g-3">

                        <div class="col-sm-6">
                            <small class="text-muted">Product SKU</small>
                            <h6>{{ $product->sku }}</h6>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Product Slug</small>
                            <h6>{{ $product->slug }}</h6>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Price</small>
                            <h5 class="text-success fw-bold">
                                Rs. {{ number_format($product->price, 2) }}
                            </h5>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Available Stock</small>
                            <h5 class="fw-bold">{{ $product->stock }} units</h5>
                        </div>

                        <div class="col-12">
                            <small class="text-muted">Description</small>
                            <p class="mt-2" style="white-space: pre-line;">{{ $product->description }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Created Date</small>
                            <p>{{ $product->created_at->format('d M Y, h:i A') }}</p>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted">Last Updated</small>
                            <p>{{ $product->updated_at->format('d M Y, h:i A') }}</p>
                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="btn btn-primary">
                            Edit Product
                        </a>

                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-outline-secondary">
                            Back to List
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
