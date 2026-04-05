
@extends('layout')
@section('title-name')
ClickIt
@endsection
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50">

        <div class="max-w-7xl mx-auto px-4 py-10">

            <!-- Breadcrumb -->
            <p class="text-sm text-gray-500 mb-6">
                Home / Dairy & Bakery / Milk
            </p>

            <!-- Product Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- LEFT: Images -->
                <div class="space-y-4">

                    <!-- Main Image -->
                    <div class="bg-white rounded-2xl shadow p-6 flex justify-center">
                        <img
                            src="{{asset('user/images/product1.avif')}}"
                            alt="Amul Toned Milk"
                            class="h-80 object-contain" />
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-4 justify-center">
                        <img
                            src="{{asset('user/images/product1.avif')}}"
                            class="w-20 h-20 object-contain bg-white rounded-xl p-2 border cursor-pointer" />
                        <img
                            src="{{asset('user/images/product2.avif')}}"
                            class="w-20 h-20 object-contain bg-white rounded-xl p-2 border cursor-pointer" />
                        <img
                            src="{{asset('user/images/product2.avif')}}"
                            class="w-20 h-20 object-contain bg-white rounded-xl p-2 border cursor-pointer" />
                    </div>

                </div>

                <!-- RIGHT: Product Info -->
                <div class="space-y-5">

                    <h1 class="text-3xl font-bold text-gray-900">
                        Amul Toned Milk
                    </h1>

                    <p class="text-gray-600">
                        Fresh & pure toned milk from Amul, ideal for daily consumption.
                    </p>

                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <span class="bg-green-600 text-white text-sm px-2 py-1 rounded-lg">
                            ★ 4.5
                        </span>
                        <span class="text-sm text-gray-500">(2,340 ratings)</span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-center gap-4">
                        <span class="text-3xl font-bold text-gray-900">₹54</span>
                        <span class="text-gray-500 line-through">₹58</span>
                        <span class="text-green-600 font-medium">7% OFF</span>
                    </div>

                    <p class="text-sm text-gray-500">
                        Inclusive of all taxes
                    </p>

                    <!-- Quantity -->
                    <div>
                        <p class="font-medium mb-2">Quantity</p>
                        <div class="flex gap-3">
                            <button class="px-4 py-2 border rounded-xl">500 ml</button>
                            <button class="px-4 py-2 border rounded-xl bg-green-100 text-green-700">
                                1 L
                            </button>
                        </div>
                    </div>

                    <!-- Delivery -->
                    <div class="bg-green-50 p-4 rounded-xl">
                        <p class="font-medium text-green-700">
                            🚀 Delivery in 10 minutes
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            Freshly sourced from nearby store
                        </p>
                    </div>

                    <!-- Add to Cart -->
                    <a href="/cart">
                        <button
                            class="w-full bg-green-600 text-white py-4 rounded-2xl text-lg font-semibold hover:bg-green-700 transition">
                            Add to Cart
                        </button>
                    </a>

                    <!-- Highlights -->
                    <div class="bg-white rounded-2xl shadow p-6 space-y-2">
                        <h2 class="text-xl font-semibold">Highlights</h2>
                        <ul class="list-disc list-inside text-gray-600">
                            <li>Pasteurised & homogenised milk</li>
                            <li>Rich source of calcium & protein</li>
                            <li>No preservatives added</li>
                            <li>Ideal for tea, coffee & daily use</li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- PRODUCT DETAILS -->
            <div class="mt-14 grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Description -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-xl font-semibold mb-3">
                        Product Description
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Amul Toned Milk is processed and packed hygienically to ensure
                        freshness and quality. It contains balanced fat and nutrients
                        suitable for everyday consumption by the whole family.
                    </p>
                </div>

                <!-- Nutrition -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h2 class="text-xl font-semibold mb-3">
                        Nutritional Information (per 100ml)
                    </h2>
                    <ul class="space-y-2 text-gray-600">
                        <li>Energy: 58 kcal</li>
                        <li>Protein: 3.2 g</li>
                        <li>Fat: 3 g</li>
                        <li>Carbohydrates: 4.8 g</li>
                        <li>Calcium: 120 mg</li>
                    </ul>
                </div>

            </div>

        </div>

    </section>
@endsection
