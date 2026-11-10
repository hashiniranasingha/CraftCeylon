@extends('layouts.app')

@section('title', 'CraftCeylon | Sri Lankan Handmade Crafts')

@section('content')

<style>
    .main-content {
        max-width: 100%;
        padding: 0;
    }

   .home-hero {
    min-height: 540px;
    display: flex;
    align-items: center;
    background:
        linear-gradient(90deg, rgba(18, 48, 34, .88), rgba(18, 48, 34, .25)),
        url('https://aartzy.com/cdn/shop/articles/traditional-arts-and-crafts-of-sri-lanka-no-text.png?v=1761695552&width=1200') center/cover;
    color: white;
    padding: 80px 8%;
}

    .hero-content {
        max-width: 650px;
    }

    .hero-label {
        color: #e0c58e;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 12px;
        font-weight: 700;
    }

    .home-hero h1 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(42px, 6vw, 68px);
        line-height: 1.15;
        margin: 22px 0;
    }

    .home-hero p {
        font-size: 17px;
        line-height: 1.9;
        color: #e9eee9;
        max-width: 560px;
    }

    .primary-btn {
        display: inline-block;
        background: #c5a66b;
        color: #183e2d;
        text-decoration: none;
        padding: 14px 28px;
        border-radius: 4px;
        font-weight: 700;
        margin-top: 20px;
        transition: .3s;
    }

    .primary-btn:hover {
        background: #e0c58e;
        color: #183e2d;
        transform: translateY(-2px);
    }

    .secondary-btn {
        display: inline-block;
        color: white;
        border: 1px solid white;
        text-decoration: none;
        padding: 13px 25px;
        border-radius: 4px;
        margin: 20px 0 0 10px;
        transition: .3s;
    }

    .secondary-btn:hover {
        background: white;
        color: #183e2d;
    }

    .home-section {
        padding: 80px 7%;
    }

    .section-heading {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 45px;
    }

    .section-heading span {
        color: #a78a55;
        font-size: 12px;
        letter-spacing: 3px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .section-heading h2 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 38px;
        color: #245c43;
        margin: 14px 0;
    }

    .section-heading p {
        color: #777d75;
        line-height: 1.8;
    }

    .category-card {
        background: white;
        border-radius: 9px;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 5px 22px rgba(0,0,0,.05);
        transition: .3s;
    }

    .category-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 30px rgba(0,0,0,.1);
    }

    .category-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .category-info {
        padding: 22px;
        text-align: center;
    }

    .category-info h4 {
        font-family: 'Playfair Display', Georgia, serif;
        color: #245c43;
        font-size: 21px;
    }

    .category-info p {
        color: #777d75;
        font-size: 14px;
        line-height: 1.7;
    }

    .category-info a {
        color: #a78a55;
        font-weight: 700;
        text-decoration: none;
        font-size: 13px;
    }

    .story-section {
        background: #eeeade;
    }

    .story-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 8px;
    }

    .story-content {
        padding: 30px;
    }

    .story-content h2 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 38px;
        color: #245c43;
        margin: 15px 0;
    }

    .story-content p {
        color: #666e65;
        line-height: 1.9;
    }

    .story-content .primary-btn {
        margin-top: 10px;
    }

    .benefit-card {
        text-align: center;
        padding: 25px 15px;
    }

    .benefit-icon {
        width: 65px;
        height: 65px;
        background: #e9eee5;
        color: #245c43;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-size: 27px;
        margin: 0 auto 18px;
    }

    .benefit-card h5 {
        color: #245c43;
        font-weight: 700;
    }

    .benefit-card p {
        color: #777d75;
        font-size: 14px;
        line-height: 1.7;
    }

    .home-cta {
        background: #245c43;
        color: white;
        text-align: center;
        padding: 75px 20px;
    }

    .home-cta h2 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 38px;
        margin-bottom: 15px;
    }

    .home-cta p {
        color: #e0e9e1;
    }

    @media(max-width: 768px) {
        .home-hero {
            min-height: 470px;
            padding: 65px 7%;
        }

        .home-section {
            padding: 55px 6%;
        }

        .section-heading h2,
        .story-content h2,
        .home-cta h2 {
            font-size: 30px;
        }

        .story-image {
            height: 300px;
        }

        .story-content {
            padding: 25px 5px;
        }

        .secondary-btn {
            margin-left: 0;
        }
    }

    
.featured-section {
    background: #fff;
}

.featured-card {
    background: #fff;
    border: 1px solid #eeeae1;
    border-radius: 9px;
    overflow: hidden;
    height: 100%;
    transition: .3s;
}

.featured-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0,0,0,.09);
}

.featured-image {
    width: 100%;
    height: 245px;
    object-fit: cover;
    background: #f1eee6;
}

.featured-info {
    padding: 20px;
}

.featured-info small {
    color: #a78a55;
    font-weight: 600;
}

.featured-info h5 {
    color: #245c43;
    font-family: 'Playfair Display', Georgia, serif;
    margin: 10px 0;
}

.featured-price {
    color: #245c43;
    font-weight: 700;
    font-size: 18px;
}

.featured-actions {
    display: flex;
    gap: 8px;
    margin-top: 15px;
}

.featured-actions a {
    text-decoration: none;
    text-align: center;
    padding: 10px 12px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    flex: 1;
}

.view-product {
    color: #245c43;
    border: 1px solid #245c43;
}

.add-product {
    background: #245c43;
    color: white;
}

.add-product:hover {
    background: #183e2d;
    color: white;
}

</style>

<!-- Hero Section -->
<section class="home-hero">
    <div class="hero-content">
        <span class="hero-label">The Beauty of Sri Lankan Heritage</span>

        <h1>Discover the Art of Handmade Treasures</h1>

        <p>
            Explore a beautiful collection of authentic Sri Lankan
            handmade crafts, thoughtfully created by skilled local
            artisans and inspired by our rich cultural heritage.
        </p>

        <a href="{{ route('products.index') }}" class="primary-btn">
            Explore Our Collection →
        </a>

        <a href="{{ url('/about') }}" class="secondary-btn">
            Discover Our Story
        </a>
    </div>
</section>

<!-- Categories Section -->
<section class="home-section">

    <div class="section-heading">
        <span>Explore Our Collection</span>
        <h2>Crafted with Passion</h2>
        <p>
            Discover traditional craftsmanship through carefully
            selected handmade creations from Sri Lanka.
        </p>
    </div>

    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="category-card">
                    <img
                        src=https://images.unsplash.com/photo-1689079565165-2aab0d935c12?auto=format&fit=crop&w=800&q=85
                        alt="Handcrafted wooden decorations">

                    <div class="category-info">
                        <h4>Wooden Crafts</h4>
                        <p>
                            Beautiful wooden creations inspired by
                            traditional Sri Lankan craftsmanship.
                        </p>
                        <a href="{{ route('products.index', ['collection' => 'wooden']) }}">EXPLORE PRODUCTS →</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card">
                    <img
                        src="https://images.unsplash.com/photo-1493106641515-6b5631de4bb9?auto=format&fit=crop&w=800&q=80"
                        alt="Handmade decorative crafts">

                    <div class="category-info">
                        <h4>Home Decorations</h4>
                        <p>
                            Unique decorative pieces that bring
                            warmth and character to your home.
                        </p>
                        <a href="{{ route('products.index', ['collection' => 'home-decoration']) }}">EXPLORE PRODUCTS →</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card">
                    <img
                        src="https://images.unsplash.com/photo-1490312278390-ab64016e0aa9?auto=format&fit=crop&w=800&q=80"
                        alt="Handmade artistic products">

                    <div class="category-info">
                        <h4>Traditional Handicrafts</h4>
                        <p>
                            Celebrate our cultural identity through
                            authentic handmade artistic creations.
                        </p>
                        <a href="{{ route('products.index', ['collection' => 'traditional']) }}">EXPLORE PRODUCTS →</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Preview -->
<section class="home-section story-section">
    <div class="container">
        <div class="row align-items-center g-4">

            <div class="col-lg-6">
                <img
                    src=https://resources.travellocal.com/wp/uploads/2023/01/26174134/dfc38154-3b01-4c4a-8763-1010e63f983c-Artist-Painting-Sri-Lanka-Traditional-Sinhalese-Craft-SS_large.jpg
                    alt="Handmade artisan crafts"
                    class="story-image">
            </div>

            <div class="col-lg-6">
                <div class="story-content">
                    <span class="hero-label">Our Story</span>

                    <h2>Preserving Tradition, Supporting Artisans</h2>

                    <p>
                        CraftCeylon celebrates the creativity,
                        dedication and traditional skills of Sri Lankan
                        artisans.
                    </p>

                    <p>
                        Our goal is to connect customers with
                        meaningful handmade products while promoting
                        local craftsmanship and cultural heritage.
                    </p>

                    <a href="{{ url('/about') }}" class="primary-btn">
                        Learn More About Us →
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Featured Products Section -->
<section class="home-section featured-section">

    <div class="section-heading">
        <span>Our Special Selection</span>
        <h2>Featured Products</h2>
        <p>
            Explore some of our special handmade creations,
            carefully selected for you.
        </p>
    </div>

    <div class="container">
        <div class="row g-4">

            @forelse($featuredProducts as $product)

                <div class="col-sm-6 col-lg-3">
                    <div class="featured-card">

                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="featured-image">
                        @else
                            <img
                                src="https://placehold.co/600x450/f1eee6/245c43?text=CraftCeylon"
                                alt="CraftCeylon product"
                                class="featured-image">
                        @endif

                        <div class="featured-info">

                            <small>
                                {{ $product->category->name }}
                            </small>

                            <h5>{{ $product->name }}</h5>

                            <div class="featured-price">
                                Rs. {{ number_format($product->price, 2) }}
                            </div>

                            <div class="featured-actions">

                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="view-product">
                                    View Details
                                </a>

                                @if($product->stock > 0)
                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="add-product">
                                        Shop Now
                                    </a>
                                @else
                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="view-product">
                                        Out of Stock
                                    </a>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-12 text-center py-4">
                    <p class="text-muted">
                        Our featured products will be available soon.
                    </p>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="primary-btn">
                View All Products →
            </a>
        </div>

    </div>
</section>

<!-- Why Choose Us -->
<section class="home-section">

    <div class="section-heading">
        <span>Why CraftCeylon</span>
        <h2>A Meaningful Way to Shop</h2>
        <p>
            Every handmade creation carries a story, a tradition
            and the dedication of its maker.
        </p>
    </div>

    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">✦</div>
                    <h5>Authentic Handmade</h5>
                    <p>
                        Discover unique creations inspired by
                        Sri Lankan culture and traditions.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">♡</div>
                    <h5>Support Local Artisans</h5>
                    <p>
                        Help celebrate the talent and dedication
                        of local craft creators.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">✓</div>
                    <h5>Convenient Shopping</h5>
                    <p>
                        Browse products, add your favourites
                        to the cart and place orders online.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="home-cta">
    <h2>Bring Home a Piece of Sri Lankan Heritage</h2>

    <p>
        Explore our handmade collection and discover something special.
    </p>

    <a href="{{ route('products.index') }}" class="primary-btn">
        Shop Our Collection →
    </a>
</section>

@endsection
