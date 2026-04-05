@extends('layout')
@section('content')
  <!-- clickIt content here  -->
  <section
    id="clickIt-content"
    class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <!-- GIF IMAGE -->
      <div class="flex justify-center">
        <img
          src="https://media.giphy.com/media/UoeaPqYrimha6rdTFV/giphy.gif"
          alt="404 Page Not Found"
          class="w-72 md:w-96" />
      </div>

      <!-- TEXT -->
      <h1 class="mt-8 text-5xl md:text-6xl font-bold text-gray-900">404</h1>

      <h2 class="mt-4 text-2xl md:text-3xl font-semibold text-gray-800">
        Oops! Page Not Found
      </h2>

      <p class="mt-4 text-gray-600 max-w-xl mx-auto">
        The page you’re looking for doesn’t exist or has been moved. Don’t
        worry, let’s get you back on track.
      </p>

      <!-- BUTTON -->
      <div class="mt-8">
        <a
          href="index.html"
          class="inline-flex items-center gap-2 bg-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-700 transition">
          Go to Home
        </a>
      </div>
    </div>
  </section>
@endsection
  