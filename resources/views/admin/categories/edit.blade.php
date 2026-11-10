
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Category</h2>
            <p class="text-muted mb-0">Update your product category details.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            Back to Categories
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.categories.update', $category) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Category Name</label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $category->name) }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image</label>

                    @if($category->image)
                        <div class="mb-2">
                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                width="120"
                                height="100"
                                style="object-fit: cover; border-radius: 8px;"
                            >
                        </div>
                    @else
                        <p class="text-muted">No image uploaded.</p>
                    @endif

                    <label for="image" class="form-label">Choose New Image</label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Maximum 2MB.</small>

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input
                        type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        class="form-check-input"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                    >

                    <label for="is_active" class="form-check-label">
                        Active Category
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    Cancel
                </a>

            </form>

        </div>
    </div>
@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Category</h2>
            <p class="text-muted mb-0">Update your product category details.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            Back to Categories
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.categories.update', $category) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Category Name</label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $category->name) }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image</label>

                    @if($category->image)
                        <div class="mb-2">
                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                width="120"
                                height="100"
                                style="object-fit: cover; border-radius: 8px;"
                            >
                        </div>
                    @else
                        <p class="text-muted">No image uploaded.</p>
                    @endif

                    <label for="image" class="form-label">Choose New Image</label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP. Maximum 2MB.</small>

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input
                        type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        class="form-check-input"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                    >

                    <label for="is_active" class="form-check-label">
                        Active Category
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>
@endsection


</div>
@endsection
