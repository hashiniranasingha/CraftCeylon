@extends('layouts.app')

@section('content')

<style>
    .product-detail-page {
        background: #f8f7f2;
        min-height: 100vh;
        padding: 50px 0 80px;
        color: #263b30;
    }

    .detail-container {
        max-width: 1180px;
        margin: auto;
        padding: 0 22px;
    }

    .back-link {
        display: inline-block;
        color: #567b62;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 30px;
    }

    .back-link:hover {
        color: #234334;
    }

    .product-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 55px;
        align-items: start;
    }

    .main-product-image {
        background: #f0eee6;
        border-radius: 12px;
        overflow: hidden;
        height: 510px;
        border: 1px solid #e9e6dc;
    }

    .main-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-information {
        padding: 20px 0;
    }

    .detail-category {
        color: #a17b43;
        font-size: 11px;
        letter-spacing: 2px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .product-information h1 {
        font-family: Georgia, serif;
        color: #234334;
        font-size: 38px;
        line-height: 1.3;
        margin-bottom: 18px;
    }

    .detail-price {
        font-size: 27px;
        font-weight: 700;
        color: #234334;
        margin-bottom: 22px;
    }

    .detail-divider {
        border: none;
        border-top: 1px solid #e5e2d9;
        margin: 24px 0;
    }

    .detail-description {
        color: #777;
        font-size: 14px;
        line-height: 1.9;
        white-space: pre-line;
    }

    .detail-meta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin: 23px 0;
    }

    .meta-item {
        background: #edf2eb;
        padding: 10px 14px;
        border-radius: 5px;
        font-size: 12px;
        color: #365c45;
    }

    .quantity-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .quantity-input {
        width: 100px;
        height: 43px;
        border: 1px solid #deded5;
        border-radius: 5px;
        padding: 8px;
        margin-bottom: 20px;
    }

    .detail-add-btn {
        display: block;
        width: 100%;
        background: #234334;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        transition: .3s;
    }

    .detail-add-btn:hover {
        background: #41664d;
    }

    .detail-add-btn:disabled {
        background: #aaa;
        cursor: not-allowed;
    }

    .detail-note {
        color: #888;
        font-size: 11px;
        text-align: center;
        margin-top: 15px;
    }

    .related-section {
        margin-top: 85px;
    }

    .related-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .related-heading small {
        color: #a17b43;
        letter-spacing: 2px;
        font-size: 11px;
        font-weight: 700;
    }

    .related-heading h2 {
        font-family: Georgia, serif;
        color: #234334;
        font-size: 32px;
        margin-top: 10px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .related-card {
        background: white;
        border: 1px solid #ebe8df;
        border-radius: 9px;
        overflow: hidden;
        transition: .3s;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(35,67,52,.08);
        color: inherit;
    }

    .related-card img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        background: #f0eee6;
    }

    .related-info {
        padding: 16px;
    }

    .related-info h3 {
        font-family: Georgia, serif;
        font-size: 16px;
        color: #234334;
        margin-bottom: 9px;
    }

    .related-info p {
        font-size: 14px;
        font-weight: 700;
        color: #567b62;
        margin: 0;
    }

    @media(max-width: 850px) {
        .product-detail-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .main-product-image {
            height: 430px;
        }

        .related-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 480px) {
        .main-product-image {
            height: 320px;
        }

        .product-information h1 {
            font-size: 30px;
        }

        .related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="product-detail-page">

    <div class="detail-container">

        <a href="{{ route('products.index') }}" class="back-link">
            ← Back to Products
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="product-detail-grid">

            <div class="main-product-image">

                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">
                @else
                    <img
                        src="https://placehold.co/800x800/f0eee6/234334?text=CraftCeylon"
                        alt="{{ $product->name }}">
                @endif

            </div>

            <div class="product-information">

                <div class="detail-category">
                    {{ $product->category->name }}
                </div>

                <h1>{{ $product->name }}</h1>

                <div class="detail-price">
                    Rs. {{ number_format($product->price, 2) }}
                </div>

                <hr class="detail-divider">

                <p class="detail-description">
                    {{ $product->description }}
                </p>

                <div class="detail-meta">

                    <div class="meta-item">
                        Handmade Sri Lankan Craft
                    </div>

                    <div class="meta-item">
                        @if($product->stock > 0)
                            In Stock
                        @else
                            Out of Stock
                        @endif
                    </div>

                </div>

                <hr class="detail-divider">

                @if($product->stock > 0)

                    <form action="{{ route('cart.add', $product->id) }}"
                          method="POST">

                        @csrf

                        <label class="quantity-label">
                            Select Quantity
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="quantity-input"
                            value="1"
                            min="1"
                            max="{{ $product->stock }}"
                            required>

                        <button type="submit" class="detail-add-btn">
                            Add to Shopping Cart →
                        </button>

                    </form>

                @else

                    <button class="detail-add-btn" disabled>
                        Currently Unavailable
                    </button>

                @endif

                <p class="detail-note">
                    Carefully crafted with traditional Sri Lankan craftsmanship.
                </p>

            </div>

        </div>

        @if($relatedProducts->count())

            <section class="related-section">

                <div class="related-heading">
                    <small>YOU MAY ALSO LIKE</small>
                    <h2>Related Creations</h2>
                </div>

                <div class="related-grid">

                    @foreach($relatedProducts as $related)

                        <a href="{{ route('products.show', $related->slug) }}"
                           class="related-card">

                            @if($related->image)
                                <img
                                    src="{{ asset('storage/' . $related->image) }}"
                                    alt="{{ $related->name }}">
                            @else
                                <img
                                    src="https://placehold.co/500x400/f0eee6/234334?text=CraftCeylon"
                                    alt="{{ $related->name }}">
                            @endif

                            <div class="related-info">
                                <h3>{{ $related->name }}</h3>
                                <p>
                                    Rs. {{ number_format($related->price, 2) }}
                                </p>
                            </div>

                        </a>

                    @endforeach

                </div>

            </section>

        @endif

    </div>

</div>

@endsection
