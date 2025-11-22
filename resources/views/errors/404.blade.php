@extends('layouts.error')

@section('content')

<div class="w-full max-w-md mx-auto p-8 text-center">

    <!-- 404 Image -->
    <img src="{{ asset('') }}" 
         alt="Page not found" 
         class="w-64 mx-auto mb-6">

    <!-- Title -->
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
        Page Not Found
    </h2>

    <!-- Message -->
    <p class="text-gray-500 dark:text-gray-300 mb-6">
        The page you’re looking for doesn’t exist or has been moved.
    </p>

    <!-- Back Button -->
    <a href="{{ route('home') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        Go Back Home
    </a>

</div>

@endsection
