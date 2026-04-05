@extends('layout')
@section('content')

<!-- clickIt content here  -->
<section id="clickIt-content" class="bg-gray-50">

    <!-- HERO SECTION -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <!-- Text -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Delivering Essentials
                    <span class="text-green-600">in Minutes</span>
                </h1>
                <p class="mt-6 text-gray-600 text-lg">
                    clickIT is India’s leading quick-commerce platform, delivering groceries,
                    daily essentials, and more to your doorstep in minutes.
                </p>
            </div>

            <!-- Image -->
            <div>
                <img
                    src="https://www.moneyisle.in/wp-content/uploads/2022/06/33.gif"
                    alt="Delivery"
                    class="rounded-2xl shadow-lg w-full object-cover" />
            </div>

        </div>
    </div>

    <!-- WHO WE ARE -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Who We Are</h2>
            <p class="mt-6 text-gray-600 max-w-3xl mx-auto">
                Founded with the mission to save your time, clickIT combines technology,
                local stores, and a strong delivery network to bring everything you need
                within minutes.
            </p>
        </div>
    </div>

    <!-- STATS -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-3xl font-bold text-green-600">10M+</h3>
                <p class="mt-2 text-gray-600">Happy Customers</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-3xl font-bold text-green-600">1,000+</h3>
                <p class="mt-2 text-gray-600">Partner Stores</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-3xl font-bold text-green-600">20+</h3>
                <p class="mt-2 text-gray-600">Cities Served</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-3xl font-bold text-green-600">10 min</h3>
                <p class="mt-2 text-gray-600">Average Delivery</p>
            </div>

        </div>
    </div>

    <!-- OUR VALUES -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900">
                Our Core Values
            </h2>

            <div class="mt-10 grid md:grid-cols-3 gap-8">

                <div class="p-6 rounded-xl border hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Speed & Reliability
                    </h3>
                    <p class="mt-3 text-gray-600">
                        We deliver essentials at lightning speed without compromising on quality.
                    </p>
                </div>

                <div class="p-6 rounded-xl border hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Customer First
                    </h3>
                    <p class="mt-3 text-gray-600">
                        Every decision we make is driven by what’s best for our customers.
                    </p>
                </div>

                <div class="p-6 rounded-xl border hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Local Empowerment
                    </h3>
                    <p class="mt-3 text-gray-600">
                        We support local stores and communities by enabling digital growth.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- HOW IT WORKS -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900">
                How clickIT Works
            </h2>

            <div class="mt-12 grid md:grid-cols-3 gap-8">

                <div class="text-center">
                    <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                        1
                    </div>
                    <h3 class="mt-4 font-semibold text-lg">Order Instantly</h3>
                    <p class="mt-2 text-gray-600">
                        Choose from thousands of products available near you.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                        2
                    </div>
                    <h3 class="mt-4 font-semibold text-lg">We Pack Fast</h3>
                    <p class="mt-2 text-gray-600">
                        Our partner stores prepare your order instantly.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                        3
                    </div>
                    <h3 class="mt-4 font-semibold text-lg">Delivered in Minutes</h3>
                    <p class="mt-2 text-gray-600">
                        A delivery partner reaches your doorstep in no time.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-green-600 py-14">
        <div class="max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-3xl font-bold">
                Experience the Future of Grocery Delivery
            </h2>
            <p class="mt-4 text-green-100">
                Download the clickIT app and get essentials delivered in minutes.
            </p>
            <button class="mt-6 bg-white text-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                Get Started
            </button>
        </div>
    </div>

</section>
@endsection