<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = $user->orders()
            ->latest()
            ->take(5)
            ->get();

        $totalOrders = $user->orders()->count();

        return view('customer.dashboard', compact(
            'user',
            'orders',
            'totalOrders'
        ));
    }
}
