<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CraftCeylon | Sri Lankan Handmade Crafts')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --forest: #245c43;
            --forest-dark: #183e2d;
            --cream: #f8f6ef;
            --gold: #c5a66b;
            --text: #303b32;
        }

        body {
            background: var(--cream);
            color: var(--text);
            font-family: 'DM Sans', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .site-navbar {
            background: #fff;
            border-bottom: 1px solid #eae7dd;
            padding: 15px 0;
        }

        .navbar-brand {
            color: var(--forest) !important;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 27px;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .brand-tagline {
            display: block;
            color: #9a865d;
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: -3px;
        }

        .site-navbar .nav-link {
            color: #38483d;
            font-size: 14px;
            font-weight: 600;
            margin: 0 8px;
            transition: .2s;
        }

        .site-navbar .nav-link:hover {
            color: var(--gold);
        }

        .login-link {
            background: var(--forest);
            color: #fff !important;
            padding: 9px 20px !important;
            border-radius: 5px;
        }

        .login-link:hover {
            background: var(--forest-dark);
            color: #fff !important;
        }

        .main-content {
            flex: 1;
            padding-top: 30px;
            padding-bottom: 40px;
        }

        .site-footer {
            background: var(--forest-dark);
            color: #e5e9e3;
            padding: 28px 15px;
            text-align: center;
            font-size: 13px;
            margin-top: auto;
        }

        .site-footer strong {
            color: #e0c58e;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 19px;
        }

        @media (max-width: 991px) {
            .site-navbar .nav-link {
                margin: 5px 0;
            }

            .login-link {
                display: inline-block;
                width: fit-content;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg site-navbar">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                CraftCeylon
                <span class="brand-tagline">The Art of Sri Lankan Craft</span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                @auth
                    @if(auth()->user()->isAdmin())
                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                    Categories
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.products.index') }}">
                                    Products
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                    Orders
                                </a>
                            </li>

                            @php
    $newMessagesCount = \App\Models\ContactMessage::where('status', 'New')->count();
@endphp

<a class="nav-link" href="{{ route('admin.contact-messages.index') }}">
    Contact Messages

    @if($newMessagesCount > 0)
        <span class="badge bg-danger">
            {{ $newMessagesCount }}
        </span>
    @endif
</a>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link border-0 bg-transparent">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link border-0 bg-transparent">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endif
                @else
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                        <li class="nav-item">
                            <a class="nav-link login-link" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                @endauth

            </div>
        </div>
    </nav>

    <main class="container main-content">
        @yield('content')
    </main>

    <footer class="site-footer">
        <strong>CraftCeylon</strong>
        <p class="mb-0 mt-2">
            Celebrating the Beauty of Sri Lankan Handmade Crafts.
        </p>
        <p class="mb-0 mt-2">
            &copy; {{ date('Y') }} CraftCeylon. All Rights Reserved.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
