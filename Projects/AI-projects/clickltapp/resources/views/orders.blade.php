@extends('layout')

@section('content')
<section class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Order History</h1>
            <p class="text-gray-500 font-medium mt-2 italic">Tracking your fresh deliveries at every step.</p>
        </div>

        @if($orders->count() > 0)
        <!-- Orders Table -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Order ID</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Placed On</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Items</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Amount</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Payment</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50/30 transition group">
                            <td class="px-8 py-6">
                                <span class="font-black text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-500">
                                {{ $order->created_at->format('d M, Y') }}<br>
                                <span class="text-[10px] text-gray-300 font-black italic">{{ $order->created_at->format('h:i A') }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-xs font-black text-gray-400 italic">{{ count($order->items) }} Products</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-black text-green-600">₹{{ number_format($order->total_amount, 2) }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $order->payment_status == 'paid' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100' }}">
                                    {{ $order->payment_method }} • {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest {{ 
                                    $order->status == 'delivered' ? 'bg-green-100 text-green-700' : 
                                    ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700')
                                }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right space-x-2">
                                <button type="button" onclick="showOrderDetails({{ $order->id }})" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-black hover:-translate-y-0.5 transition shadow-lg shadow-gray-100">
                                    <i class="bi bi-eye"></i> Track
                                </button>
                                <a href="{{ route('orders.downloadInvoice', $order) }}" title="Download Invoice" class="inline-flex items-center justify-center p-2 text-green-600 hover:bg-green-50 rounded-lg transition">
                                    <i class="bi bi-file-earmark-pdf text-lg"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Details Modal Row (Hidden by default, triggered by JS) -->
                        <div id="modal-{{ $order->id }}" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm items-center justify-center p-4">
                            <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl relative overflow-hidden animate-in fade-in zoom-in duration-300">
                                <!-- Modal Header -->
                                <div class="bg-gray-50 px-10 py-6 border-b border-gray-100 flex justify-between items-center">
                                    <div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Order Summary</p>
                                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                                    </div>
                                    <button onclick="closeOrderDetails({{ $order->id }})" class="w-10 h-10 rounded-full hover:bg-gray-200 flex items-center justify-center transition">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>

                                <!-- Modal Content -->
                                <div class="p-10 space-y-10 max-h-[70vh] overflow-y-auto">
                                    <!-- Tracking Timeline -->
                                    <div class="relative pt-4 pb-8">
                                        <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-100 -translate-y-1/2 rounded-full"></div>
                                        <div class="absolute top-1/2 left-0 h-1 bg-green-500 -translate-y-1/2 rounded-full transition-all duration-1000" style="width: {{ 
                                            $order->status == 'pending' ? '12.5%' : 
                                            ($order->status == 'processing' ? '37.5%' : 
                                            ($order->status == 'shipped' ? '62.5%' : 
                                            ($order->status == 'delivered' ? '100%' : '0%')))
                                        }}"></div>
                                        
                                        <div class="relative flex justify-between">
                                            @foreach(['pending' => 'Ordered', 'processing' => 'Packed', 'shipped' => 'On Way', 'delivered' => 'Delivered'] as $key => $label)
                                                <div class="flex flex-col items-center">
                                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold z-10 {{ 
                                                        ($order->status == $key || ($order->status == 'delivered' && $key != 'delivered') || ($order->status == 'shipped' && in_array($key, ['pending', 'processing'])) || ($order->status == 'processing' && $key == 'pending')) 
                                                        ? 'bg-green-600 text-white border-4 border-green-50' 
                                                        : 'bg-white text-gray-400 border-4 border-gray-50'
                                                    }}">
                                                        <i class="bi {{ $key == 'delivered' ? 'bi-star-fill' : 'bi-check-lg' }}"></i>
                                                    </div>
                                                    <span class="absolute -bottom-8 text-[9px] font-black uppercase tracking-widest text-center {{ $order->status == $key ? 'text-green-600 font-bold' : 'text-gray-400' }}">{{ $label }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Grid Details -->
                                    <div class="grid grid-cols-2 gap-8 pt-6 border-t border-gray-50">
                                        <div>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Delivery Address</p>
                                            <p class="text-sm font-medium text-gray-600 italic leading-relaxed">{{ $order->address }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Expected by</p>
                                            <p class="text-sm font-black text-gray-900">{{ $order->created_at->addDays(3)->format('M d, Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- Order Items -->
                                    <div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Line Items</p>
                                        <div class="space-y-3">
                                            @foreach($order->items as $item)
                                            <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-12 h-12 bg-white rounded-lg p-1">
                                                        <img src="{{ asset($item->product->image) }}" class="w-full h-full object-contain">
                                                    </div>
                                                    <div>
                                                        <h4 class="text-sm font-black text-gray-900">{{ $item->product->name }}</h4>
                                                        <p class="text-[10px] text-gray-500 font-bold italic">{{ $item->quantity }} × {{ $item->product->unit }}</p>
                                                    </div>
                                                </div>
                                                <span class="text-sm font-black tracking-tighter">₹{{ number_format($item->price * $item->quantity, 2) }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <!-- Summary -->
                                    <div class="bg-gray-900 rounded-3xl p-6 flex justify-between items-center text-white">
                                        <div>
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Paid</p>
                                            <p class="text-xl font-black">₹{{ number_format($order->total_amount, 2) }}</p>
                                        </div>
                                        <a href="{{ route('orders.downloadInvoice', $order) }}" class="px-5 py-2.5 bg-green-500 rounded-xl text-xs font-black hover:bg-green-600 transition shadow-lg shadow-green-900">
                                            Download Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="max-w-md mx-auto bg-white p-12 rounded-[2.5rem] shadow-2xl text-center border border-gray-50">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="bi bi-cart-x text-5xl text-gray-200"></i>
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">No Orders Yet</h2>
            <p class="text-gray-500 font-medium mt-3 italic mb-8">Your shopping journey is just one click away!</p>
            <a href="{{ route('product') }}" class="w-full inline-flex items-center justify-center gap-3 bg-green-600 text-white py-4 px-6 rounded-2xl font-black text-lg shadow-xl shadow-green-100 hover:bg-green-700 hover:-translate-y-1 transition-all duration-300">
                Start Shopping <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<script>
    function showOrderDetails(orderId) {
        const modal = document.getElementById(`modal-${orderId}`);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeOrderDetails(orderId) {
        const modal = document.getElementById(`modal-${orderId}`);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            });
            document.body.style.overflow = 'auto';
        }
    });

    // Close on click outside modal content
    window.onclick = function(event) {
        if (event.target.id.startsWith('modal-')) {
            event.target.classList.remove('flex');
            event.target.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>
@endsection