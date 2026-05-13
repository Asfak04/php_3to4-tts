@extends('admin.layout')

@section('admin_content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Overview</h2>
    <p class="text-gray-500 mt-1 font-medium">Welcome back to the ClickIT admin panel. Here's what's happening today.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <!-- Total Products -->
    <a href="{{ route('admin.products.index') }}" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md group">
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <i class="bi bi-box text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Products</p>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_products }}</h3>
            </div>
        </div>
        <p class="text-xs text-blue-600 font-bold bg-blue-50 py-1 px-3 rounded-full inline-block">Total Inventory</p>
    </a>

    <!-- Total Categories -->
    <a href="{{ route('admin.categories.index') }}" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md group">
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <i class="bi bi-grid text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Categories</p>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_categories }}</h3>
            </div>
        </div>
        <p class="text-xs text-purple-600 font-bold bg-purple-50 py-1 px-3 rounded-full inline-block">Product Groups</p>
    </a>

    <!-- Total Orders -->
    <a href="{{ route('admin.orders.index') }}" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md group">
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-green-50 text-green-600 rounded-2xl group-hover:bg-green-600 group-hover:text-white transition-colors">
                <i class="bi bi-cart-check text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Orders</p>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_orders }}</h3>
            </div>
        </div>
        <p class="text-xs text-green-600 font-bold bg-green-50 py-1 px-3 rounded-full inline-block">Completed & Pending</p>
    </a>

    <!-- Total Users -->
    <a href="{{ route('admin.users.index') }}" class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md group">
        <div class="flex items-center gap-4 mb-4">
            <div class="p-3 bg-orange-50 text-orange-600 rounded-2xl group-hover:bg-orange-600 group-hover:text-white transition-colors">
                <i class="bi bi-people text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Customers</p>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $total_users }}</h3>
            </div>
        </div>
        <p class="text-xs text-orange-600 font-bold bg-orange-50 py-1 px-3 rounded-full inline-block">Registered Users</p>
    </a>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="p-8 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-xl font-bold text-gray-900">Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-green-600 hover:text-green-700 transition">View All Orders →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Order ID</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Customer</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Total</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recent_orders as $order)
                    <tr class="hover:bg-gray-50/50 transition cursor-default">
                        <td class="px-8 py-5 font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-5 font-bold text-gray-900">{{ $order->user->name }}</td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest {{ 
                                $order->status == 'delivered' ? 'bg-green-100 text-green-700' : 
                                ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                ($order->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'))
                            }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 font-extrabold text-gray-900">₹{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-8 py-5 text-gray-500 font-medium text-right text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-gray-500 font-medium italic">No recent orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
