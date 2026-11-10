@extends('layouts.app')

@section('title', 'My Dashboard | CraftCeylon')

@push('styles')
<style>
    .customer-dashboard {
        background: #f6f8f2;
        min-height: 80vh;
        padding: 45px 0 70px;
    }

    .dashboard-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .dashboard-heading h1 {
        color: #174a32;
        font-size: 30px;
        font-weight: 750;
        margin-bottom: 7px;
    }

    .dashboard-heading p {
        color: #77877b;
        margin: 0;
    }

    .dashboard-btn {
        display: inline-block;
        background: linear-gradient(135deg, #20583c, #398052);
        color: white;
        padding: 12px 23px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 650;
        transition: .3s;
    }

    .dashboard-btn:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 7px 18px rgba(32, 88, 60, .2);
    }

    /* Welcome Banner */
    .welcome-card {
        background: linear-gradient(120deg, #174a32, #398052);
        color: white;
        border-radius: 20px;
        padding: 35px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(23, 74, 50, .12);
    }

    .welcome-card h2 {
        font-size: 27px;
        font-weight: 750;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .welcome-card p {
        color: #e2eee5;
        margin: 0;
        max-width: 600px;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .welcome-decoration {
        position: absolute;
        right: 45px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 90px;
        opacity: .18;
    }

    /* Statistics Cards */
    .stat-card {
        height: 100%;
        min-height: 165px;
        border-radius: 17px;
        padding: 23px;
        position: relative;
        overflow: hidden;
        border: 1px solid transparent;
        box-shadow: 0 7px 22px rgba(20, 55, 35, .06);
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(20, 55, 35, .1);
    }

    .stat-total {
        background: linear-gradient(135deg, #e2f3e7, #f5fbf5);
        border-color: #cce5d2;
    }

    .stat-pending {
        background: linear-gradient(135deg, #fff0d8, #fff9ed);
        border-color: #f3dfbd;
    }

    .stat-completed {
        background: linear-gradient(135deg, #e3edff, #f4f7ff);
        border-color: #d4e0f5;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 27px;
    }

    .stat-total .stat-icon {
        background: #c9e8d1;
    }

    .stat-pending .stat-icon {
        background: #ffe4b9;
    }

    .stat-completed .stat-icon {
        background: #d5e3ff;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 650;
        color: #64766a;
        margin-bottom: 5px;
    }

    .stat-card h3 {
        font-size: 34px;
        font-weight: 800;
        margin: 0;
        color: #174a32;
    }

    .stat-description {
        font-size: 12px;
        color: #839087;
        margin-top: 5px;
    }

    /* Section Cards */
    .section-card {
        background: #fff;
        border: 1px solid #e6eee6;
        border-radius: 17px;
        padding: 25px;
        height: 100%;
        box-shadow: 0 6px 22px rgba(20, 55, 35, .05);
    }

    .section-title {
        color: #174a32;
        font-size: 19px;
        font-weight: 750;
        margin-bottom: 22px;
    }

    /* Recent Orders */
    .order-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .order-table th {
        background: #f3f7f2;
        color: #63776a;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 14px 12px;
        white-space: nowrap;
    }

    .order-table td {
        padding: 16px 12px;
        border-bottom: 1px solid #edf1ed;
        color: #46594c;
        font-size: 14px;
        vertical-align: middle;
    }

    .order-number {
        color: #20583c;
        font-weight: 750;
    }

    .order-number a {
        color: #20583c;
        text-decoration: none;
    }

    .order-number a:hover {
        color: #b38b3d;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 750;
        text-transform: capitalize;
    }

    .status-pending {
        background: #fff0d5;
        color: #a66c0d;
    }

    .status-processing {
        background: #e4efff;
        color: #2862a9;
    }

    .status-completed,
    .status-delivered {
        background: #e2f4e8;
        color: #247341;
    }

    .status-cancelled {
        background: #ffe7e7;
        color: #b43b3b;
    }

    /* Empty Orders */
    .empty-orders {
        text-align: center;
        padding: 35px 15px;
        color: #829087;
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .empty-orders h5 {
        color: #31583e;
        font-weight: 700;
    }

    .empty-orders p {
        font-size: 14px;
    }

    /* Quick Actions */
    .quick-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px;
        border: 1px solid #e8eee8;
        border-radius: 13px;
        text-decoration: none;
        color: #294c37;
        margin-bottom: 13px;
        background: #fff;
        transition: .25s;
    }

    .quick-link:hover {
        border-color: #80ae8c;
        background: #f4faf5;
        color: #20583c;
        transform: translateX(4px);
        box-shadow: 0 5px 14px rgba(32, 88, 60, .07);
    }

    .quick-link-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 23px;
    }

    .quick-shop {
        background: #e2f3e7;
    }

    .quick-cart {
        background: #fff0d8;
    }

    .quick-orders {
        background: #e3edff;
    }

    .quick-contact {
        background: #e5edff;
    }

    .quick-logout {
        background: #ffe8e8;
    }

    .quick-link strong {
        display: block;
        font-size: 14px;
        font-weight: 750;
        color: #294c37;
    }

    .quick-link small {
        display: block;
        color: #829087;
        font-size: 12px;
        margin-top: 4px;
    }

    .quick-arrow {
        margin-left: auto;
        color: #8b9b8f;
        font-size: 20px;
    }

    .logout-button {
        width: 100%;
        border: 1px solid #e8eee8;
        text-align: left;
        cursor: pointer;
    }

    .logout-button:hover {
        background: #fff7f7;
        border-color: #e7bcbc;
    }

    @media (max-width: 767px) {
        .customer-dashboard {
            padding: 28px 0 45px;
        }

        .dashboard-heading h1 {
            font-size: 25px;
        }

        .welcome-card {
            padding: 25px;
        }

        .welcome-card h2 {
            font-size: 22px;
        }

        .welcome-decoration {
            right: 15px;
            font-size: 55px;
        }

        .section-card {
            padding: 18px;
        }

        .stat-card {
            min-height: 150px;
        }
    }
</style>
@endpush

@section('content')

<div class="customer-dashboard">
    <div class="container">

        <!-- Dashboard Heading -->
        <div class="dashboard-heading">
            <div>
                <h1>My Dashboard</h1>
                <p>Manage your CraftCeylon account and orders.</p>
            </div>

            <a href="{{ route('products.index') }}" class="dashboard-btn">
                🛍️ Shop Now
            </a>
        </div>

        <!-- Welcome Banner -->
        <div class="welcome-card">
            <h2>Welcome back, {{ $user->name }}! 👋</h2>

            <p>
                Thank you for choosing CraftCeylon.
                Explore beautiful handmade crafts from Sri Lanka.
            </p>

            <div class="welcome-decoration">🌿</div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="stat-card stat-total">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Total Orders</div>
                            <h3>{{ $totalOrders }}</h3>
                        </div>

                        <div class="stat-icon">🛍️</div>
                    </div>

                    <div class="stat-description">
                        All your placed orders
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card stat-pending">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Pending Orders</div>
                            <h3>{{ $user->orders()->where('order_status', 'pending')->count() }}</h3>
                        </div>

                        <div class="stat-icon">⏳</div>
                    </div>

                    <div class="stat-description">
                        Orders waiting for processing
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card stat-completed">
                    <div class="stat-top">
                        <div>
                            <div class="stat-label">Completed Orders</div>
                            <h3>{{ $user->orders()->whereIn('order_status', ['completed', 'delivered'])->count() }}</h3>
                        </div>

                        <div class="stat-icon">✅</div>
                    </div>

                    <div class="stat-description">
                        Successfully completed orders
                    </div>
                </div>
            </div>

        </div>

        <!-- Orders and Quick Actions -->
        <div class="row g-4">

            <!-- Recent Orders -->
            <div class="col-lg-8">
                <div class="section-card">

                    <h3 class="section-title">
                        📦 Recent Orders
                    </h3>

                    @if($orders->count() > 0)

                        <div class="table-responsive">
                            <table class="order-table">

                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="order-number">
                                                <a href="{{ route('customer.orders.show', $order->id) }}">
                                                    {{ $order->order_number }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>

                                            <td>
                                                Rs. {{ number_format($order->total_amount, 2) }}
                                            </td>

                                            <td>
                                                <span class="status-badge status-{{ strtolower($order->order_status) }}">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('customer.orders.index') }}"
                               class="dashboard-btn">
                                View All Orders →
                            </a>
                        </div>

                    @else

                        <div class="empty-orders">
                            <div class="empty-icon">🛍️</div>

                            <h5>No Orders Yet</h5>

                            <p>
                                You haven't placed any orders yet.
                                Start exploring our handmade collections!
                            </p>

                            <a href="{{ route('products.index') }}"
                               class="dashboard-btn mt-2">
                                Explore Products
                            </a>
                        </div>

                    @endif

                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="section-card">

                    <h3 class="section-title">
                        ⚡ Quick Actions
                    </h3>

                    <a href="{{ route('products.index') }}" class="quick-link">

                        <div class="quick-link-icon quick-shop">🛍️</div>

                        <div>
                            <strong>Browse Products</strong>
                            <small>Explore handmade collections</small>
                        </div>

                        <span class="quick-arrow">›</span>

                    </a>

                    <a href="{{ route('cart.index') }}" class="quick-link">

                        <div class="quick-link-icon quick-cart">🛒</div>

                        <div>
                            <strong>Shopping Cart</strong>
                            <small>View your selected products</small>
                        </div>

                        <span class="quick-arrow">›</span>

                    </a>

                    <!-- My Orders -->
                    <a href="{{ route('customer.orders.index') }}" class="quick-link">

                        <div class="quick-link-icon quick-orders">📦</div>

                        <div>
                            <strong>My Orders</strong>
                            <small>View your order history and details</small>
                        </div>

                        <span class="quick-arrow">›</span>

                    </a>

                    <a href="{{ route('contact') }}" class="quick-link">

                        <div class="quick-link-icon quick-contact">💬</div>

                        <div>
                            <strong>Contact Us</strong>
                            <small>Get help and support</small>
                        </div>

                        <span class="quick-arrow">›</span>

                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                                class="quick-link logout-button">

                            <div class="quick-link-icon quick-logout">🚪</div>

                            <div>
                                <strong>Logout</strong>
                                <small>Sign out of your account</small>
                            </div>

                            <span class="quick-arrow">›</span>

                        </button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection
