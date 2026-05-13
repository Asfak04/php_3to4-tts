@extends('layout')

@section('content')
<section class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-[2.5rem] shadow-2xl text-center relative overflow-hidden transition-all hover:shadow-red-50">
        <!-- Error Icon -->
        <div class="mx-auto h-24 w-24 bg-red-50 rounded-full flex items-center justify-center mb-8 animate-pulse">
            <i class="bi bi-x-circle text-5xl text-red-500"></i>
        </div>

        <div class="space-y-4">
            <h2 class="text-4xl font-black text-gray-900 tracking-tight">Payment Failed!</h2>
            <p class="text-gray-500 font-medium text-lg leading-relaxed">
                Something went wrong while processing your payment. Your money (if deducted) will be refunded within 3-5 working days.
            </p>
        </div>

        <!-- Error Details (if any) -->
        @if(isset($error))
            <div class="mt-8 p-6 bg-red-50/50 rounded-2xl border border-red-50 space-y-3">
                <span class="text-xs font-bold text-red-400 uppercase tracking-widest block mb-1">Reason</span>
                <p class="font-bold text-red-600 text-sm italic">"{{ $error }}"</p>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-10 space-y-4">
            <a href="{{ route('cart') }}" class="w-full flex items-center justify-center gap-3 bg-gray-900 text-white py-4 px-6 rounded-2xl font-bold text-lg shadow-lg hover:bg-black hover:-translate-y-1 transition-all duration-300">
                <i class="bi bi-arrow-repeat"></i> Try Again From Cart
            </a>
            <a href="{{ route('product') }}" class="w-full flex items-center justify-center gap-2 text-gray-500 font-bold hover:text-gray-900 transition-colors py-2">
                 Explore Products <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-50 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-red-50 rounded-full opacity-30 blur-3xl"></div>
    </div>
</section>
@endsection
