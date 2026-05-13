@extends('layout')

@section('content')
<section class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-[2.5rem] shadow-2xl text-center relative overflow-hidden transition-all hover:shadow-green-100">
        <!-- Success Animation/Icon -->
        <div class="mx-auto h-24 w-24 bg-green-100 rounded-full flex items-center justify-center mb-8 animate-bounce">
            <i class="bi bi-check-lg text-5xl text-green-600"></i>
        </div>

        <div class="space-y-4">
            <h2 class="text-4xl font-black text-gray-900 tracking-tight">Payment Successful!</h2>
            <p class="text-gray-500 font-medium text-lg leading-relaxed">
                Thank you for your order. We've received your payment and our team is already packing your fresh items!
            </p>
        </div>

        <!-- Order Summary Card -->
        <div class="mt-8 p-6 bg-gray-50 rounded-2xl border border-gray-100 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Order ID</span>
                <span class="font-black text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Amount Paid</span>
                <span class="font-black text-green-600 text-lg">₹{{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Payment Mode</span>
                <span class="font-bold text-gray-700">Online (Razorpay)</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-10 space-y-4">
            <a href="{{ route('orders') }}" class="w-full flex items-center justify-center gap-3 bg-green-600 text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-lg shadow-green-100 hover:bg-green-700 hover:-translate-y-1 transition-all duration-300">
                <i class="bi bi-box-seam"></i> Track My Order
            </a>
            <a href="{{ route('product') }}" class="w-full flex items-center justify-center gap-2 text-gray-500 font-bold hover:text-gray-900 transition-colors py-2">
                Continue Shopping <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-green-50 rounded-full opacity-50 blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-green-50 rounded-full opacity-50 blur-3xl"></div>
    </div>
</section>
@endsection
