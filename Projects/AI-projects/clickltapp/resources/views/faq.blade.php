@extends('layout')
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50">

        <!-- HERO -->
        <div class="max-w-7xl mx-auto px-4 py-14 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                Fast Ask Questions
            </h1>
            <p class="mt-4 text-gray-600 text-lg">
                Quick answers to common questions about ordering, delivery, payments, and more.
            </p>
        </div>

        <!-- FAQ CONTENT -->
        <div class="max-w-4xl mx-auto px-4 pb-16 space-y-4">

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        How fast does clickIT deliver?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    clickIT typically delivers essentials within 10–15 minutes,
                    depending on your location and product availability.
                </p>
            </details>

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        What products can I order?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    You can order groceries, fruits & vegetables, dairy products,
                    snacks, beverages, personal care items, and household essentials.
                </p>
            </details>

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Is there a minimum order value?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Minimum order value may vary by city and store.
                    You’ll see the exact amount before checkout.
                </p>
            </details>

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        What payment methods are accepted?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    We accept UPI, credit/debit cards, net banking, wallets,
                    and cash on delivery in select locations.
                </p>
            </details>

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Can I cancel or modify my order?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    Orders can be modified or canceled before they are packed.
                    Once dispatched, cancellation may not be possible.
                </p>
            </details>

            <!-- FAQ Item -->
            <details class="group bg-white rounded-2xl shadow p-6">
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h3 class="text-lg font-semibold text-gray-900">
                        What if an item is missing or damaged?
                    </h3>
                    <span class="text-green-600 text-2xl group-open:rotate-45 transition">
                        +
                    </span>
                </summary>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    You can report issues directly from the app.
                    Our support team will quickly resolve it with a refund or replacement.
                </p>
            </details>

        </div>

        <!-- SUPPORT CTA -->
        <div class="bg-green-600 py-12">
            <div class="max-w-7xl mx-auto px-4 text-center text-white">
                <h2 class="text-3xl font-bold">
                    Still Have Questions?
                </h2>
                <p class="mt-3 text-green-100">
                    Our support team is always ready to help you.
                </p>
                <button
                    class="mt-6 bg-white text-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                    Contact Support
                </button>
            </div>
        </div>

    </section>
@endsection