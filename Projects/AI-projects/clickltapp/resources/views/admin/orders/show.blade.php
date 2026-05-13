@extends('admin.layout')

@section('admin_content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.orders.index') }}" class="p-2 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-gray-900 transition shadow-sm">
        <i class="bi bi-arrow-left text-xl"></i>
    </a>
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Order #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-gray-500 mt-1 font-medium">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Items -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-bag-check text-green-500"></i> Order Items
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Product</th>
                            <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Unit Price</th>
                            <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Qty</th>
                            <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 flex items-center justify-center p-2 flex-shrink-0">
                                            @if($item->product->image)
                                                <img src="{{ asset($item->product->image) }}" class="h-full w-full object-contain">
                                            @else
                                                <i class="bi bi-box text-gray-300"></i>
                                            @endif
                                        </div>
                                        <span class="font-bold text-gray-900">{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center font-bold text-gray-500">₹{{ number_format($item->price, 2) }}</td>
                                <td class="px-8 py-5 text-center font-bold text-gray-900">{{ $item->quantity }}</td>
                                <td class="px-8 py-5 text-right font-extrabold text-gray-900">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50/50">
                            <td colspan="3" class="px-8 py-6 text-right font-bold text-gray-500 tracking-widest uppercase text-sm">Grand Total:</td>
                            <td class="px-8 py-6 text-right font-extrabold text-2xl text-green-600 tracking-tight">₹{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <!-- Delivery Details & Payment -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="bi bi-geo-alt text-orange-500"></i> Delivery & Payment Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-4 md:col-span-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Delivery Address</p>
                    <p class="font-bold text-gray-700 leading-relaxed">{{ $order->address ?? 'N/A' }}</p>
                </div>
                <div class="space-y-4 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                    <div class="flex justify-between items-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Payment Method</p>
                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-xs font-bold text-gray-900">{{ strtoupper($order->payment_method ?? 'COD') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</p>
                        <span class="text-xs font-bold {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">{{ strtoupper($order->payment_status ?? 'pending') }}</span>
                    </div>
                    @if($order->transaction_id)
                        <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Transaction ID</p>
                            <span class="text-[10px] font-mono font-bold text-gray-600">{{ $order->transaction_id }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar: Customer & Status -->
    <div class="space-y-8">
        <!-- Customer Info -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6 tracking-tight uppercase tracking-widest text-xs text-gray-400">Customer Info</h3>
            <div class="flex items-center gap-4 mb-6">
                <div class="h-14 w-14 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                    <i class="bi bi-person-fill text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-lg">{{ $order->user->name }}</h4>
                    <p class="text-sm font-bold text-gray-400 tracking-tight mt-0.5 lowercase italic">{{ $order->user->email }}</p>
                </div>
            </div>
            <a href="mailto:{{ $order->user->email }}" class="w-full flex items-center justify-center gap-2 py-3 border border-gray-100 rounded-2xl text-sm font-bold text-gray-600 hover:bg-gray-100 transition">
                <i class="bi bi-envelope"></i> Contact Customer
            </a>
        </div>

        <!-- Order Status -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6 tracking-tight uppercase tracking-widest text-xs text-gray-400">Order Status</h3>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-green-500 transition font-extrabold uppercase tracking-widest text-sm
                    {{ $order->status == 'delivered' ? 'text-green-600' : ($order->status == 'pending' ? 'text-yellow-600' : 'text-blue-600') }}">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>SHIPPED</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>DELIVERED</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                </select>
                <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-black transition shadow-lg shadow-gray-100 flex items-center justify-center gap-2">
                    <i class="bi bi-arrow-repeat"></i> Update Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
