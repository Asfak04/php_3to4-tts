@extends('admin.layout')

@section('admin_content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Order Management</h2>
    <p class="text-gray-500 mt-1 font-medium">View and process customer orders.</p>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-8">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1 w-full">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Search Orders</label>
            <div class="relative">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Order ID, Customer Name or Email..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-medium">
            </div>
        </div>
        <div class="w-full md:w-56">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status</label>
            <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-bold uppercase text-xs tracking-widest">
                <option value="">ALL STATUSES</option>
                @foreach($statusOptions ?? ['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $option)
                    <option value="{{ $option }}" {{ request('status') == $option ? 'selected' : '' }}>{{ strtoupper($option) }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-2xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-100 flex items-center justify-center gap-2">
                Filter
            </button>
            @if(request()->filled('search') || request()->filled('status'))
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-3 bg-gray-100 text-gray-500 rounded-2xl font-bold hover:bg-gray-200 hover:text-gray-700 transition flex items-center justify-center">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Order ID</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Customer</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Items</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Payment</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Total</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5 font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">{{ $order->user->name }}</span>
                                <span class="text-xs text-gray-400 font-medium tracking-tight mt-0.5 italic lowercase">{{ $order->user->email }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center font-bold text-gray-500 text-sm italic">{{ $order->items_count ?? $order->items()->count() }} items</td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest {{ 
                                $order->status == 'delivered' ? 'bg-green-100 text-green-700' : 
                                ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                ($order->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'))
                            }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border {{ 
                                $order->payment_status == 'paid' ? 'bg-green-50 text-green-600 border-green-200' : 'bg-yellow-50 text-yellow-600 border-yellow-200'
                            }}">
                                {{ $order->payment_status ?? 'pending' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 font-extrabold text-gray-900">₹{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-100">
                                <i class="bi bi-eye"></i> Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-gray-500 font-medium italic">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
