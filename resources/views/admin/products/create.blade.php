@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
           class="text-decoration-none text-muted">
            ← Back to Products
        </a>

        <h2 class="fw-bold mt-3 mb-1">Add New Product</h2>
        <p class="text-muted">Add a handmade product to CraftCeylon store.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('admin.products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold">Product Name *</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Enter product name"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Category *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Product Description *</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="5"
                                  placeholder="Describe the handmade product..."
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Price (Rs.) *</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               value="{{ old('price') }}"
                               min="0.01"
                               step="0.01"
                               placeholder="2500.00"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Stock Quantity *</label>
                        <input type="number"
                               name="stock"
                               class="form-control"
                               value="{{ old('stock', 0) }}"
                               min="0"
                               placeholder="10"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">SKU *</label>
                        <input type="text"
                               name="sku"
                               class="form-control"
                               value="{{ old('sku') }}"
                               placeholder="CC-CRAFT-001"
                               required>
                        <small class="text-muted">Unique product code.</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Product Image</label>
                        <input type="file"
                               name="image"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">
                            Allowed: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   class="form-check-input"
                                   id="is_active"
                                   {{ old('is_active', '1') == '1' ? 'checked' : '' }}>

                            <label class="form-check-label" for="is_active">
                                Active Product
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="is_featured"
                                   value="1"
                                   class="form-check-input"
                                   id="is_featured"
                                   {{ old('is_featured') == '1' ? 'checked' : '' }}>

                            <label class="form-check-label" for="is_featured">
                                Featured Product
                            </label>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        Save Product
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
