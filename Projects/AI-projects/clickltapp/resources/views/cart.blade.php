@extends('layout')

@section('content')
<section class="bg-gray-50/50 min-h-screen py-12 md:py-20 animate-in fade-in duration-700">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Page Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Your <span class="text-green-600">Shopping Cart</span></h1>
            <p class="text-gray-400 font-medium mt-2 italic">Review your fresh picks before checkout.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            
            <!-- LEFT: Items List -->
            <div class="lg:col-span-2 space-y-6">
                @php $total = 0 @endphp
                @if(session('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <div class="bg-white rounded-[2.5rem] p-6 md:p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8 group hover:shadow-xl transition-all duration-500">
                            <!-- Image Container -->
                            <div class="w-32 h-32 bg-gray-50 rounded-3xl p-4 flex-shrink-0 group-hover:scale-105 transition-transform duration-500">
                                <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-contain">
                            </div>

                            <!-- Product Info -->
                            <div class="flex-grow text-center md:text-left space-y-2">
                                <h3 class="text-xl font-black text-gray-900 tracking-tight">{{ $details['name'] }}</h3>
                                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest italic">{{ $details['unit'] }}</span>
                                    <span class="text-xs font-black text-green-600 uppercase tracking-widest"><i class="bi bi-lightning-fill"></i> Fast Delivery</span>
                                </div>
                                <p class="text-lg font-black text-gray-900">₹{{ number_format($details['price']) }}</p>
                            </div>

                            <!-- Quantity & Subtotal -->
                            <div class="flex flex-col items-center md:items-end gap-4 w-full md:w-auto border-t md:border-t-0 pt-4 md:pt-0 border-gray-50">
                                <p class="text-xl font-black text-gray-900 tracking-tighter">₹{{ number_format($details['price'] * $details['quantity']) }}</p>
                                
                                <div class="flex items-center gap-6">
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center bg-gray-50 rounded-2xl p-1 border border-gray-100">
                                        <button type="button" 
                                            onclick="updateCartQuantity('{{ $id }}', {{ $details['quantity'] - 1 }})"
                                            class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-green-600 hover:bg-white rounded-xl transition-all {{ $details['quantity'] <= 1 ? 'opacity-20 pointer-events-none' : '' }}">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                        <span class="w-12 text-center font-black text-gray-900">{{ $details['quantity'] }}</span>
                                        <button type="button" 
                                            onclick="updateCartQuantity('{{ $id }}', {{ $details['quantity'] + 1 }})"
                                            class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-green-600 hover:bg-white rounded-xl transition-all">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>

                                    <form action="{{ route('remove.from.cart') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-[3rem] p-16 text-center border border-gray-100 shadow-sm">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="bi bi-cart-x text-5xl text-gray-200"></i>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Your cart is silent</h2>
                        <p class="text-gray-500 font-medium mt-3 italic mb-8">Fill it with freshness and joy!</p>
                        <a href="{{ route('product') }}" class="inline-flex items-center gap-3 bg-green-600 text-white py-4 px-8 rounded-2xl font-black text-lg shadow-xl shadow-green-100 hover:bg-green-700 hover:-translate-y-1 transition-all duration-300">
                            Browse Products <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- RIGHT: Checkout Summary -->
            @if($total > 0)
            <div class="space-y-8 animate-in slide-in-from-right duration-700">
                <!-- Summary Card -->
                <div class="bg-gray-900 text-white p-10 rounded-[3rem] shadow-2xl space-y-8 relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 text-9xl opacity-10 group-hover:rotate-12 transition-transform duration-700">🛒</div>
                    
                    <h2 class="text-2xl font-black tracking-tight border-l-4 border-green-500 pl-6">Order Summary</h2>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-bold uppercase tracking-widest">Subtotal</span>
                            <span class="font-black">₹{{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-bold uppercase tracking-widest">Delivery Free</span>
                            <span class="font-black text-green-500">₹10.00</span>
                        </div>
                        <div class="h-px bg-white/10 my-4"></div>
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total to Pay</p>
                                <p class="text-4xl font-black tracking-tighter">₹{{ number_format($total + 10) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <form id="checkout-form" action="{{ route('checkout') }}" method="POST" class="space-y-8">
                    @csrf
                    <!-- Address Section -->
                    <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm space-y-6">
                        <h3 class="text-xl font-black text-gray-900 tracking-tight">Delivery Address</h3>
                        <div class="relative group">
                            <i class="bi bi-geo-alt absolute left-4 top-4 text-gray-300 group-focus-within:text-green-500 transition-colors"></i>
                            <textarea name="address" required class="w-full bg-gray-50 border border-transparent rounded-2xl pl-12 pr-4 py-4 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:bg-white transition-all min-h-[100px]" placeholder="Flat No, Street, Landmark..."></textarea>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm space-y-6">
                        <h3 class="text-xl font-black text-gray-900 tracking-tight">Payment Path</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <label class="relative flex items-center gap-4 p-5 bg-gray-50 rounded-2xl cursor-pointer border border-transparent hover:border-green-200 transition-all">
                                <input type="radio" name="payment_method" value="COD" checked class="w-5 h-5 text-green-600 focus:ring-green-500">
                                <div class="flex-grow">
                                    <p class="font-black text-gray-900 leading-none">Cash on Delivery</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Pay when you receive</p>
                                </div>
                                <i class="bi bi-wallet2 text-xl text-gray-300"></i>
                            </label>
                            
                            <label class="relative flex items-center gap-4 p-5 bg-gray-100/50 rounded-2xl cursor-pointer border border-transparent hover:border-green-200 transition-all opacity-80 ring-1 ring-green-100">
                                <input type="radio" name="payment_method" value="Online" class="w-5 h-5 text-green-600 focus:ring-green-500">
                                <div class="flex-grow">
                                    <p class="font-black text-gray-900 leading-none">Online Payment</p>
                                    <p class="text-[10px] font-bold text-green-500 uppercase tracking-widest mt-1">Secure • Razorpay</p>
                                </div>
                                <i class="bi bi-shield-lock text-xl text-green-600"></i>
                            </label>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button type="submit" id="checkout-btn" class="w-full bg-green-600 text-white py-6 rounded-[2rem] font-black text-xl uppercase tracking-widest shadow-2xl shadow-green-200 hover:bg-green-700 hover:-translate-y-1 active:scale-95 transition-all duration-300">
                        Confirm Purchase <i class="bi bi-chevron-right ml-2"></i>
                    </button>
                    
                    <p class="text-center text-[10px] font-black text-gray-300 uppercase tracking-widest">
                        By confirming, you agree to our terms of service
                    </p>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Razorpay Integration -->
@if($total > 0)
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function updateCartQuantity(id, quantity) {
        if (quantity < 1) return;
        
        // Use Fetch API to update quantity via AJAX
        fetch('{{ route("update.cart") }}', {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh the page to update all totals instantly
                window.location.reload();
            } else {
                alert('Update failed. Please retry.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('A connection error occurred.');
        });
    }

    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        let method = document.querySelector('input[name="payment_method"]:checked').value;
        let address = document.querySelector('textarea[name="address"]').value;
        let btn = document.getElementById('checkout-btn');

        if (method === 'Online') {
            e.preventDefault();
            btn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i> Initializing Pay...';
            btn.classList.add('opacity-70', 'pointer-events-none');

            fetch('{{ route("razorpay.order") }}', { 
                method: "POST", 
                headers: { 
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", 
                    "Content-Type": "application/json" 
                } 
            })
            .then(r => r.json())
            .then(data => {
                if(data.error) { 
                    alert('Razorpay Error: ' + data.error); 
                    btn.innerHTML = 'Confirm Purchase <i class="bi bi-chevron-right ml-2"></i>';
                    btn.classList.remove('opacity-70', 'pointer-events-none');
                    return; 
                }
                
                var options = {
                    "key": "{{ config('services.razorpay.key') }}",
                    "amount": data.amount,
                    "currency": "INR",
                    "name": "ClickIT App",
                    "description": "Secure Shopping Checkout",
                    "image": "https://img.icons8.com/color/96/000000/fresh-food.png",
                    "order_id": data.order_id,
                    "handler": function (response){
                        btn.innerHTML = '<i class="bi bi-shield-check"></i> Securing Transaction...';
                        
                        let form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("razorpay.callback") }}';
                        form.innerHTML = `
                            @csrf
                            <input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">
                            <input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">
                            <input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">
                            <input type="hidden" name="address" value="${address.replace(/"/g, '&quot;')}">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    },
                    "prefill": {
                        "name": "{{ Auth::check() ? Auth::user()->name : '' }}",
                        "email": "{{ Auth::check() ? Auth::user()->email : '' }}"
                    },
                    "theme": { "color": "#10b981" }
                };
                
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response){
                    alert("Payment Failed. Reason: " + response.error.description);
                    btn.innerHTML = 'Confirm Purchase <i class="bi bi-chevron-right ml-2"></i>';
                    btn.classList.remove('opacity-70', 'pointer-events-none');
                });
                rzp1.open();
            })
            .catch(err => {
                alert("Something went wrong. Please check your connection.");
                btn.innerHTML = 'Confirm Purchase <i class="bi bi-chevron-right ml-2"></i>';
                btn.classList.remove('opacity-70', 'pointer-events-none');
            });
        }
    });
</script>
@endif
@endsection