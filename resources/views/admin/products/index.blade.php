@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Product Management</h2>
            <p class="text-muted mb-0">Manage all CraftCeylon products.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            + Add New Product
        </a>
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

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th width="190">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            width="55"
                                            height="55"
                                            class="rounded"
                                            style="object-fit: cover;"
                                        >
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width:55px;height:55px;">
                                            <span class="text-muted small">No Image</span>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $product->name }}</strong>

                                    @if($product->is_featured)
                                        <br>
                                        <span class="badge bg-warning text-dark">Featured</span>
                                    @endif
                                </td>

                                <td>{{ $product->category->name ?? 'N/A' }}</td>

                                <td>{{ $product->sku }}</td>

                                <td>Rs. {{ number_format($product->price, 2) }}</td>

                                <td>
                                    @if($product->stock > 0)
                                        <span class="badge bg-success">
                                            {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @endif
                                </td>

                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.products.show', $product) }}"
                                       class="btn btn-sm btn-outline-info">
                                        View
                                    </a>

                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <h5 class="text-muted">No Products Found</h5>
                                    <p class="text-muted mb-3">
                                        Start adding handmade products to your store.
                                    </p>
                                    <a href="{{ route('admin.products.create') }}"
                                       class="btn btn-success">
                                        Add First Product
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
