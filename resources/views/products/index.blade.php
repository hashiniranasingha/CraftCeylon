@extends('layouts.app')

@section('content')

<style>
    .products-page {
        background: #f8f7f2;
        min-height: 100vh;
        padding: 55px 0 80px;
        color: #263b30;
    }

    .products-container {
        max-width: 1240px;
        margin: auto;
        padding: 0 22px;
    }

    .products-hero {
        background: #234334;
        border-radius: 14px;
        padding: 55px 45px;
        margin-bottom: 45px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .products-hero::after {
        content: "CRAFT";
        position: absolute;
        right: 20px;
        bottom: -35px;
        font-family: Georgia, serif;
        font-size: 110px;
        font-weight: bold;
        color: rgba(255,255,255,.06);
    }

    .products-hero small {
        color: #d6b77b;
        letter-spacing: 3px;
        font-size: 11px;
        font-weight: 700;
    }

    .products-hero h1 {
        font-family: Georgia, serif;
        font-size: 44px;
        margin: 14px 0;
    }

    .products-hero p {
        max-width: 550px;
        color: #e1e9e1;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
    }

    .products-layout {
        display: grid;
        grid-template-columns: 245px 1fr;
        gap: 35px;
        align-items: start;
    }

    .filter-card {
        background: white;
        border: 1px solid #e9e6dc;
        border-radius: 10px;
        padding: 25px;
    }

    .filter-card h3 {
        font-family: Georgia, serif;
        color: #234334;
        font-size: 22px;
        margin-bottom: 22px;
    }

    .filter-link {
        display: block;
        text-decoration: none;
        color: #737970;
        padding: 11px 13px;
        border-radius: 6px;
        font-size: 13px;
        margin-bottom: 5px;
        transition: .2s;
    }

    .filter-link:hover,
    .filter-link.active {
        background: #edf2eb;
        color: #234334;
        font-weight: 600;
    }

    .products-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 23px;
        gap: 15px;
    }

    .products-toolbar h2 {
        font-family: Georgia, serif;
        color: #234334;
        font-size: 25px;
        margin: 0;
    }

    .products-toolbar p {
        color: #888;
        font-size: 12px;
        margin: 5px 0 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 23px;
    }

    .product-card {
        background: white;
        border: 1px solid #ebe8df;
        border-radius: 10px;
        overflow: hidden;
        transition: .3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(35,67,52,.09);
    }

    .product-image {
        height: 230px;
        background: #f0eee6;
        position: relative;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .featured-label {
        position: absolute;
        top: 13px;
        left: 13px;
        background: #d8bb83;
        color: #293d30;
        padding: 6px 11px;
        border-radius: 3px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .product-info {
        padding: 19px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-category {
        color: #a17b43;
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .product-info h3 {
        font-family: Georgia, serif;
        font-size: 18px;
        color: #294635;
        margin-bottom: 10px;
    }

    .product-price {
        color: #234334;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .stock-text {
        color: #66856c;
        font-size: 11px;
        margin-bottom: 14px;
    }

    .product-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }

    .details-btn,
    .add-cart-btn {
        flex: 1;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        padding: 10px 5px;
        font-size: 11px;
        font-weight: 600;
        transition: .2s;
    }

    .details-btn {
        color: #234334;
        border: 1px solid #234334;
        background: white;
    }

    .details-btn:hover {
        background: #edf2eb;
        color: #234334;
    }

    .add-cart-btn {
        color: white;
        background: #234334;
        border: 1px solid #234334;
    }

    .add-cart-btn:hover {
        background: #41664d;
        color: white;
    }

    .add-cart-btn:disabled {
        background: #aaa;
        border-color: #aaa;
        cursor: not-allowed;
    }

    .empty-products {
        background: white;
        border: 1px solid #e9e6dc;
        border-radius: 10px;
        padding: 60px 20px;
        text-align: center;
        color: #777;
    }

    .pagination {
        margin-top: 35px;
    }

    @media(max-width: 1050px) {
        .products-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 700px) {
        .products-layout {
            grid-template-columns: 1fr;
        }

        .products-hero {
            padding: 40px 25px;
        }

        .products-hero h1 {
            font-size: 34px;
        }
    }

    @media(max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr;
        }

        .products-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .product-image {
            height: 250px;
        }
    }
</style>

<div class="products-page">

    <div class="products-container">

        <section class="products-hero">
            <small>CRAFTCEYLON COLLECTION</small>
            <h1>Discover Handmade Treasures</h1>
            <p>
                Explore the beauty of Sri Lankan craftsmanship.
                Discover unique handmade creations, thoughtfully
                crafted by local artisans with tradition and care.
            </p>
        </section>

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

        <div class="products-layout">

            <aside class="filter-card">

                <h3>Categories</h3>

                <a href="{{ route('products.index') }}"
                   class="filter-link {{ !request('category') ? 'active' : '' }}">
                    All Products
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                       class="filter-link {{ request('category') == $category->slug ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach

            </aside>

            <main>

                <div class="products-toolbar">
                    <div>
                        <h2>Our Products</h2>
                        <p>{{ $products->total() }} handmade products available</p>
                    </div>
                </div>

                @if($products->count())

                    <div class="products-grid">

                        @foreach($products as $product)

                            <article class="product-card">

                                <div class="product-image">

                                    @if($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}">
                                    @else
                                        <img
                                            src="https://placehold.co/600x500/f0eee6/234334?text=CraftCeylon"
                                            alt="{{ $product->name }}">
                                    @endif

                                    @if($product->is_featured)
                                        <span class="featured-label">FEATURED</span>
                                    @endif

                                </div>

                                <div class="product-info">

                                    <div class="product-category">
                                        {{ $product->category->name }}
                                    </div>

                                    <h3>{{ $product->name }}</h3>

                                    <div class="product-price">
                                        Rs. {{ number_format($product->price, 2) }}
                                    </div>

                                    <div class="stock-text">
                                        @if($product->stock > 0)
                                            In Stock
                                        @else
                                            Currently Unavailable
                                        @endif
                                    </div>

                                    <div class="product-actions">

                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="details-btn">
                                            View Details
                                        </a>

                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}"
                                                  method="POST"
                                                  style="flex:1;">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">

                                                <button type="submit"
                                                        class="add-cart-btn w-100">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button class="add-cart-btn" disabled>
                                                Out of Stock
                                            </button>
                                        @endif

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                    <div class="pagination">
                        {{ $products->links() }}
                    </div>

                @else

                    <div class="empty-products">
                        <h3>No Products Found</h3>
                        <p>There are currently no products in this collection.</p>
                        <a href="{{ route('products.index') }}"
                           class="details-btn d-inline-block mt-3">
                            View All Products
                        </a>
                    </div>

                @endif

            </main>

        </div>

    </div>

</div>

@endsection
