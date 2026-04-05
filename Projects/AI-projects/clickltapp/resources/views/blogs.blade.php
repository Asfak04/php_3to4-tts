@extends('layout')
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50">

        <!-- PAGE HEADER -->
        <div class="max-w-7xl mx-auto px-4 py-14 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                ClickIt Blog
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Stories, updates, and insights from the world of quick commerce.
            </p>
        </div>

        <!-- BLOG GRID -->
        <div class="max-w-7xl mx-auto px-4 pb-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1542838132-92c53300491e"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on April 10, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        How ClickIt Delivers Groceries in Minutes
                    </h2>
                    <p class="mt-3 text-gray-600">
                        Learn how our smart logistics and local store partnerships
                        enable ultra-fast deliveries.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1521791136064-7986c2920216"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on March 28, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        Behind the Scenes: Our Delivery Network
                    </h2>
                    <p class="mt-3 text-gray-600">
                        A deep dive into the systems and people that power ClickIt’s speed.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1492724441997-5dc865305da7"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on March 15, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        Supporting Local Stores with Technology
                    </h2>
                    <p class="mt-3 text-gray-600">
                        How ClickIt empowers neighborhood stores to grow digitally.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on February 25, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        Sustainability at ClickIt
                    </h2>
                    <p class="mt-3 text-gray-600">
                        Our efforts toward eco-friendly packaging and greener deliveries.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1556761175-4b46a572b786"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on February 5, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        Life at ClickIt: Culture & Growth
                    </h2>
                    <p class="mt-3 text-gray-600">
                        Discover what makes ClickIt a great place to work and grow.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

            <!-- Blog Card -->
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1492724441997-5dc865305da7"
                    alt="Blog Image"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <p class="text-sm text-gray-500">
                        Published on January 18, 2025
                    </p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        The Future of Quick Commerce in India
                    </h2>
                    <p class="mt-3 text-gray-600">
                        Trends and innovations shaping the next phase of instant delivery.
                    </p>
                    <button
                        class="mt-5 inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Read More
                    </button>
                </div>
            </div>

        </div>

    </section>
@endsection