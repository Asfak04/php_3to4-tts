<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total_products = Product::count();
        $total_categories = Category::count();
        $total_orders = Order::count();
        $total_users = User::count();
        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('total_products', 'total_categories', 'total_orders', 'total_users', 'recent_orders'));
    }
}
