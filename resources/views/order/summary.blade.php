@extends('layouts.main')

@section('title', 'Summary')

@section('content')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="flex justify-center items-center">
        {{-- Progress Bar --}}
        <ol class="pl-0 items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
        <li class="after:border-1 flex items-center text-red-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
            <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
            <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Cart
            </span>
            <hr class="border-2 w-full mx-3">
        </li>

        <li class="after:border-1 flex items-center text-red-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
            <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
            <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Checkout
            </span>
            <hr class="w-full mx-3 border-2">
        </li>

        <li class="flex shrink-0 items-center text-nowrap text-red-700">
            <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Order summary
        </li>
        </ol>
    </div>

    <div class="mx-auto max-w-2xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Thanks for your order!</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">#{{ $orders->id }}</a> will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.</p>
        <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Date</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $orders->payment->format('d M Y, H:i') }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $user->name }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Email</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $user->email }}</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Address</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $user->address }}</dd>
            </dl>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('orders.track', $orders->id) }}" class="no-underline text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Track your order</a>
            <a href="{{ route('products.index') }}" class="no-underline py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Return to shopping</a>
        </div>
    </div>
</section>
@endsection
