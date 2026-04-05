@extends('layout')
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50 min-h-screen flex items-center justify-center">

        <div class="max-w-4xl mx-auto px-4 py-16 text-center space-y-8">

            <!-- Confirmation GIF -->
            <div class="flex justify-center">
                <img
                    src="https://media.giphy.com/media/111ebonMs90YLu/giphy.gif"
                    alt="Order Confirmed"
                    class="w-64 md:w-80" />
            </div>

            <!-- Confirmation Text -->
            <h1 class="text-4xl md:text-5xl font-bold text-green-600">
                Order Confirmed!
            </h1>
            <p class="text-gray-700 text-lg md:text-xl">
                Thank you for your purchase. Your order has been successfully placed and is being processed.
            </p>

            <!-- Order Details -->
            <div class="bg-white rounded-2xl shadow p-6 text-left max-w-2xl mx-auto space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Order Details</h2>

                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span>Order Number:</span>
                    <span class="font-medium">#CLKT123456</span>
                </div>

                <div class="flex justify-between border-b border-gray-200 pb-2 pt-2">
                    <span>Order Date:</span>
                    <span class="font-medium">December 17, 2025</span>
                </div>

                <div class="flex justify-between border-b border-gray-200 pb-2 pt-2">
                    <span>Delivery Address:</span>
                    <span class="font-medium">123, Tech Park, Bengaluru, Karnataka – 560103</span>
                </div>

                <!-- Ordered Items -->
                <div class="pt-2">
                    <h3 class="font-semibold text-gray-900 mb-2">Items Ordered</h3>

                    <!-- Item 1 -->
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-4">
                            <img src="{{asset('user/images/product1.avif')}}"
                                alt="Amul Milk" class="w-16 h-16 object-contain rounded-lg">
                            <div>
                                <p class="font-medium">Amul Toned Milk - 1 L</p>
                                <p class="text-gray-500 text-sm">Quantity: 1</p>
                            </div>
                        </div>
                        <p class="font-medium">₹54</p>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center gap-4">
                            <img src="{{asset('user/images/product2.avif')}}"
                                alt="Amul Gold Milk" class="w-16 h-16 object-contain rounded-lg">
                            <div>
                                <p class="font-medium">Amul Gold Milk - 500 ml</p>
                                <p class="text-gray-500 text-sm">Quantity: 2</p>
                            </div>
                        </div>
                        <p class="font-medium">₹108</p>
                    </div>
                </div>

                <!-- Total -->
                <div class="flex justify-between border-t border-gray-200 pt-3 font-bold text-gray-900 text-lg">
                    <span>Total Amount:</span>
                    <span>₹162</span>
                </div>
            </div>

            <!-- Print Invoice Button -->
            <button
                onclick="window.print()"
                class="mt-6 bg-green-600 text-white px-8 py-3 rounded-2xl font-semibold hover:bg-green-700 transition">
                Print Invoice
            </button>

        </div>

    </section>
@endsection
  

   
  