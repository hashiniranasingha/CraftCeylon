@extends('layouts.app')

@section('title', 'About Us | CraftCeylon')

@section('content')

<style>
    .main-content {
        max-width: 100%;
        padding: 0;
    }

    .about-hero {
        min-height: 380px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 70px 20px;
        background:
            linear-gradient(rgba(18, 48, 34, .82), rgba(18, 48, 34, .72)),
            url('https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1800&q=85')
            center/cover;
    }

    .about-hero span {
        color: #e0c58e;
        letter-spacing: 4px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .about-hero h1 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(42px, 6vw, 60px);
        margin: 20px 0;
    }

    .about-hero p {
        max-width: 650px;
        margin: auto;
        color: #e8eee8;
        line-height: 1.8;
        font-size: 16px;
    }

    .about-section {
        padding: 75px 7%;
    }

    .about-label {
        color: #a78a55;
        font-size: 12px;
        letter-spacing: 3px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .about-title {
        color: #245c43;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 38px;
        margin: 15px 0 20px;
    }

    .about-text {
        color: #687068;
        line-height: 1.95;
        font-size: 15px;
    }

    .about-main-image {
        width: 100%;
        height: 430px;
        object-fit: cover;
        border-radius: 9px;
    }

    .mission-section {
        background: #eeeade;
    }

    .mission-card {
        background: white;
        padding: 35px 28px;
        border-radius: 9px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0,0,0,.04);
    }

    .mission-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e9eee5;
        color: #245c43;
        font-size: 26px;
        margin-bottom: 20px;
    }

    .mission-card h3 {
        color: #245c43;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 25px;
        margin-bottom: 15px;
    }

    .mission-card p {
        color: #687068;
        line-height: 1.85;
        font-size: 14px;
        margin-bottom: 0;
    }

    .heritage-section {
        background: #fff;
    }

    .heritage-image {
        width: 100%;
        height: 390px;
        object-fit: cover;
        border-radius: 9px;
    }

    .heritage-list {
        list-style: none;
        padding: 0;
        margin-top: 22px;
    }

    .heritage-list li {
        color: #59665c;
        margin-bottom: 15px;
        line-height: 1.7;
    }

    .heritage-list li span {
        color: #a78a55;
        font-weight: 700;
        margin-right: 10px;
    }

    .about-cta {
        background: #245c43;
        color: white;
        text-align: center;
        padding: 70px 20px;
    }

    .about-cta h2 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 36px;
        margin-bottom: 15px;
    }

    .about-cta p {
        color: #e1eae2;
        line-height: 1.8;
    }

    .about-btn {
        display: inline-block;
        background: #c5a66b;
        color: #183e2d;
        text-decoration: none;
        padding: 13px 28px;
        border-radius: 4px;
        font-weight: 700;
        margin-top: 15px;
    }

    .about-btn:hover {
        background: #e0c58e;
        color: #183e2d;
    }

    @media(max-width: 768px) {
        .about-section {
            padding: 50px 6%;
        }

        .about-main-image,
        .heritage-image {
            height: 290px;
        }

        .about-title,
        .about-cta h2 {
            font-size: 30px;
        }
    }
</style>

<!-- About Hero -->
<section class="about-hero">
    <div>
        <span>Welcome to CraftCeylon</span>

        <h1>Our Story & Heritage</h1>

        <p>
            Celebrating the creativity, traditions and craftsmanship
            that make Sri Lankan handmade products truly special.
        </p>
    </div>
</section>

<!-- Who We Are -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
    <img
        src="https://madeinkataragama.com/aimage.jpeg"
        alt="Traditional Sri Lankan Handmade Crafts"
        class="about-main-image">
</div>

            <div class="col-lg-6">

                <span class="about-label">Who We Are</span>

                <h2 class="about-title">
                    Bringing Sri Lankan Craftsmanship Closer to You
                </h2>

                <p class="about-text">
                    CraftCeylon is an online platform dedicated to
                    showcasing the beauty and creativity of Sri Lankan
                    handmade crafts.
                </p>

                <p class="about-text">
                    Inspired by our island's rich cultural heritage,
                    we aim to connect customers with unique handmade
                    creations that reflect traditional skills,
                    artistic expression and local creativity.
                </p>

                <p class="about-text">
                    Through our online store, customers can explore
                    different craft collections, discover special
                    products and conveniently place orders.
                </p>

            </div>
        </div>
    </div>
</section>

<!-- Mission and Vision -->
<section class="about-section mission-section">

    <div class="section-heading">
        <span class="about-label">Our Purpose</span>
        <h2 class="about-title">Mission & Vision</h2>
        <p class="about-text">
            Our purpose is to celebrate local creativity and
            make Sri Lankan handmade crafts more accessible.
        </p>
    </div>

    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="mission-card">
                    <div class="mission-icon">✦</div>

                    <h3>Our Mission</h3>

                    <p>
                        To promote Sri Lankan handmade crafts by
                        providing an accessible online shopping
                        experience and connecting customers with
                        unique traditional and creative products.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mission-card">
                    <div class="mission-icon">◎</div>

                    <h3>Our Vision</h3>

                    <p>
                        To become a trusted online destination
                        for Sri Lankan handmade crafts while
                        celebrating cultural heritage and
                        supporting the growth of local craftsmanship.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sri Lankan Heritage -->
<section class="about-section heritage-section">

    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <span class="about-label">Our Inspiration</span>

                <h2 class="about-title">
                    The Beauty of Sri Lankan Heritage
                </h2>

                <p class="about-text">
                    Sri Lanka has a rich tradition of handmade
                    craftsmanship, shaped by generations of
                    creativity, cultural influences and artistic skills.
                </p>

                <p class="about-text">
                    From detailed wood carvings to colourful
                    decorative creations, traditional crafts
                    represent the creativity and identity of our island.
                </p>

                <ul class="heritage-list">
                    <li><span>✦</span> Traditional artistic craftsmanship</li>
                    <li><span>✦</span> Unique handmade creations</li>
                    <li><span>✦</span> Cultural inspiration and creativity</li>
                    <li><span>✦</span> Appreciation of local craftsmanship</li>
                </ul>

            </div>

            <div class="col-lg-6">
                <img
                    src=https://loomlane.live/assets/images/about-section.png
                    alt="Traditional craft and creative work"
                    class="heritage-image">
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="about-cta">

    <h2>Discover Something Truly Special</h2>

    <p>
        Explore our collection and experience the beauty
        of Sri Lankan handmade craftsmanship.
    </p>

    <a href="{{ route('products.index') }}" class="about-btn">
        Explore Our Products →
    </a>

</section>

@endsection
