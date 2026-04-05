
@extends('layout')    
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 py-10">

            <!-- Page Title -->
            <h1 class="text-3xl font-bold text-gray-900 mb-6">
                Your Cart
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT: Cart Items -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Cart Item -->
                    <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row items-center gap-6">
                        <img
                            src="{{asset('user/images/product1.avif')}}"
                            alt="Amul Toned Milk"
                            class="w-32 h-32 object-contain rounded-xl" />
                        <div class="flex-1 space-y-2">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Amul Toned Milk - 1 L
                            </h2>
                            <p class="text-gray-600">Fresh & pure milk, ideal for daily consumption</p>
                            <p class="text-green-600 font-medium">Delivery in 10 minutes</p>

                            <!-- Quantity -->
                            <div class="flex items-center gap-2 mt-2">
                                <button class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                                <span class="px-3 py-1 border rounded-lg">1</span>
                                <button class="px-3 py-1 bg-gray-200 rounded-lg">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">₹54</p>
                            <button class="mt-2 text-red-600 hover:underline text-sm">
                                Remove
                            </button>
                        </div>
                    </div>

                    <!-- Another Cart Item -->
                    <div class="bg-white rounded-2xl shadow p-6 flex flex-col md:flex-row items-center gap-6">
                        <img
                            src="{{asset('user/images/product2.avif')}}"
                            alt="Amul Gold Milk"
                            class="w-32 h-32 object-contain rounded-xl" />
                        <div class="flex-1 space-y-2">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Amul Gold Milk - 500 ml
                            </h2>
                            <p class="text-gray-600">Premium milk for your family’s health</p>
                            <p class="text-green-600 font-medium">Delivery in 10 minutes</p>

                            <!-- Quantity -->
                            <div class="flex items-center gap-2 mt-2">
                                <button class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                                <span class="px-3 py-1 border rounded-lg">2</span>
                                <button class="px-3 py-1 bg-gray-200 rounded-lg">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">₹108</p>
                            <button class="mt-2 text-red-600 hover:underline text-sm">
                                Remove
                            </button>
                        </div>
                    </div>

                </div>

                <!-- RIGHT: Summary & Checkout -->
                <div class="space-y-6">

                    <!-- Price Summary -->
                    <div class="bg-white p-6 rounded-2xl shadow space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-900">Price Details</h2>

                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal (3 items)</span>
                            <span>₹162</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Delivery Charges</span>
                            <span>₹10</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="flex justify-between text-gray-900 font-bold text-xl">
                            <span>Total Amount</span>
                            <span>₹172</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white p-6 rounded-2xl shadow space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-900">Payment Method</h2>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="payment" class="form-radio text-green-600">
                                <span>Cash on Delivery (COD)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="payment" class="form-radio text-green-600">
                                <span>Online Payment</span>
                            </label>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="/orders"><button
                            class="w-full bg-green-600 text-white py-4 rounded-2xl text-lg font-semibold hover:bg-green-700 transition">
                            Proceed to Checkout
                        </button>
                    </a>

                </div>

            </div>

        </div>

    </section>
@endsection