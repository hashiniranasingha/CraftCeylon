
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Category Details</h2>
            <p class="text-muted mb-0">View CraftCeylon category information.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            Back to Categories
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row g-4">

                <div class="col-md-4">
                    <h6 class="text-muted">Category Image</h6>

                    @if($category->image)
                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="img-fluid rounded"
                            style="max-height: 250px; object-fit: cover;"
                        >
                    @else
                        <div class="bg-light rounded p-5 text-center text-muted">
                            No image available
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">{{ $category->name }}</h3>

                    <p><strong>Slug:</strong> {{ $category->slug }}</p>

                    <p>
                        <strong>Description:</strong><br>
                        {{ $category->description ?: 'No description available.' }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        @if($category->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>

                    <p>
                        <strong>Created At:</strong>
                        {{ $category->created_at->format('Y-m-d H:i') }}
                    </p>

                    <p>
                        <strong>Last Updated:</strong>
                        {{ $category->updated_at->format('Y-m-d H:i') }}
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="btn btn-primary">
                            Edit Category
                        </a>

                        <a href="{{ route('admin.categories.index') }}"
                           class="btn btn-light">
                            Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
