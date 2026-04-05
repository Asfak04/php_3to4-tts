@extends('layout')
@section('content')
    <!-- clickIt content here  -->
    <section id="clickIt-content" class="bg-gray-50">

        <!-- HERO -->
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid md:grid-cols-2 gap-10 items-center">

                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                        Build the Future of
                        <span class="text-green-600">Quick Commerce</span>
                    </h1>
                    <p class="mt-6 text-gray-600 text-lg">
                        Join clickIT and help deliver happiness to millions in minutes.
                        We’re building fast, scalable, and impactful technology.
                    </p>
                    <button class="mt-6 bg-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                        View Open Positions
                    </button>
                </div>

                <div>
                    <img
                        src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
                        alt="Team"
                        class="rounded-2xl shadow-lg w-full object-cover" />
                </div>

            </div>
        </div>

        <!-- WHY JOIN -->
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900">
                    Why Join clickIT?
                </h2>

                <div class="mt-12 grid md:grid-cols-3 gap-8">

                    <div class="p-6 rounded-xl border hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold">Fast Growth</h3>
                        <p class="mt-3 text-gray-600">
                            Work in a high-growth environment where your impact is visible daily.
                        </p>
                    </div>

                    <div class="p-6 rounded-xl border hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold">Ownership Mindset</h3>
                        <p class="mt-3 text-gray-600">
                            We empower teams to take ownership and innovate fearlessly.
                        </p>
                    </div>

                    <div class="p-6 rounded-xl border hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold">People First</h3>
                        <p class="mt-3 text-gray-600">
                            Inclusive culture, flexible work, and strong support systems.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- JOB OPENINGS -->
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4">

                <h2 class="text-3xl font-bold text-center text-gray-900">
                    Current Openings
                </h2>

                <!-- Filters -->
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <span class="px-4 py-2 bg-green-100 text-green-600 rounded-full text-sm">
                        Engineering
                    </span>
                    <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm">
                        Operations
                    </span>
                    <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm">
                        Marketing
                    </span>
                    <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-full text-sm">
                        Design
                    </span>
                </div>

                <!-- Job Cards -->
                <div class="mt-12 space-y-6">

                    <!-- Job 1 -->
                    <div class="bg-white rounded-xl p-6 shadow flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Frontend Engineer
                            </h3>
                            <p class="mt-1 text-gray-600 text-sm">
                                Bengaluru · Full Time · Engineering
                            </p>
                        </div>
                        <button command="show-modal"
                            commandfor="dialog3" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                            Apply Now
                        </button>
                    </div>

                    <!-- Job 2 -->
                    <div class="bg-white rounded-xl p-6 shadow flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Backend Engineer
                            </h3>
                            <p class="mt-1 text-gray-600 text-sm">
                                Remote · Full Time · Engineering
                            </p>
                        </div>
                        <button command="show-modal"
                            commandfor="dialog3" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                            Apply Now
                        </button>
                    </div>

                    <!-- Job 3 -->
                    <div class="bg-white rounded-xl p-6 shadow flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Operations Manager
                            </h3>
                            <p class="mt-1 text-gray-600 text-sm">
                                Delhi · Full Time · Operations
                            </p>
                        </div>
                        <button command="show-modal"
                            commandfor="dialog3" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                            Apply Now
                        </button>
                    </div>

                    <!-- Job 4 -->
                    <div class="bg-white rounded-xl p-6 shadow flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Growth Marketing Lead
                            </h3>
                            <p class="mt-1 text-gray-600 text-sm">
                                Mumbai · Full Time · Marketing
                            </p>
                        </div>
                        <button command="show-modal"
                            commandfor="dialog3" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                            Apply Now
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- HIRING PROCESS -->
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4">

                <h2 class="text-3xl font-bold text-center text-gray-900">
                    Our Hiring Process
                </h2>

                <div class="mt-12 grid md:grid-cols-4 gap-8 text-center">

                    <div>
                        <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <h3 class="mt-4 font-semibold">Apply</h3>
                        <p class="mt-2 text-gray-600">
                            Submit your application online.
                        </p>
                    </div>

                    <div>
                        <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <h3 class="mt-4 font-semibold">Screening</h3>
                        <p class="mt-2 text-gray-600">
                            Initial discussion with our team.
                        </p>
                    </div>

                    <div>
                        <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                            3
                        </div>
                        <h3 class="mt-4 font-semibold">Interviews</h3>
                        <p class="mt-2 text-gray-600">
                            Technical and culture-fit interviews.
                        </p>
                    </div>

                    <div>
                        <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">
                            4
                        </div>
                        <h3 class="mt-4 font-semibold">Offer</h3>
                        <p class="mt-2 text-gray-600">
                            Welcome to the clickIT family!
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-green-600 py-14">
            <div class="max-w-7xl mx-auto px-4 text-center text-white">
                <h2 class="text-3xl font-bold">
                    Ready to Make an Impact?
                </h2>
                <p class="mt-4 text-green-100">
                    Apply today and be part of a fast-moving team.
                </p>
                <a href="contact.html"><button class="mt-6 bg-white text-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                        Explore Careers
                    </button></a>
            </div>
        </div>

    </section>
@endsection