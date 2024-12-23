@extends('layouts.main')

@section('title', 'About')

@section('content')
<div class="container mx-auto p-6">
    <!-- Hero Section -->
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0">
            <div class="content-center justify-self-start items-center md:col-span-7 md:text-start">
                <h3
                    class="mt-20 text-2xl font-extrabold leading-none tracking-tight dark:text-white md:max-w-1xl md:text-large xl:text-1xl">
                    About Us
                </h3>
                <h1
                    class="text-4xl font-extrabold leading-none tracking-tight dark:text-white md:max-w-2xl md:text-5xl xl:text-6xl">
                    Global Moms Care</h1>
                <p class="max-w-2xl text-gray-500 dark:text-gray-400 md:mb-12 md:text-lg mb-3 lg:mb-5 lg:text-xl">
                    Your path to happy and healthy family</p>
            </div>
            <div class="hidden md:col-span-5 md:mt-0 md:flex">
                <img class="dark:hidden" src="{{ asset('images/auth/home.jpg')}}" alt="shopping illustration" />
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                    <h3 class="text-2xl font-bold mb-4 text-red-500">Our Mission</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        To create a comprehensive platform that provides mothers with essential products,
                        community support, and expert healthcare guidance. We aim to simplify the parenting
                        journey by offering a one-stop solution for all maternal and childcare needs from
                        pregnancy through early childhood.
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                    <h3 class="text-2xl font-bold mb-4 text-red-500">Our Vision</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        To become the world's leading marketplace and community platform for mothers,
                        where they can easily access quality products, connect with other parents, and
                        receive trusted healthcare information. We envision a future where every mother
                        has the resources they need at their fingertips.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">What We Offer</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-lg shadow">
                    <div class="bg-red-500/10 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-shopping-basket text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Products & Essentials</h3>
                    <p class="text-gray-600 dark:text-gray-300">Shop for quality baby essentials, maternity needs, and childcare products for ages 0-5</p>
                </div>
                <div class="text-center p-6 bg-white rounded-lg shadow">
                    <div class="bg-red-500/10 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-users text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Community Connection</h3>
                    <p class="text-gray-600 dark:text-gray-300">Connect with other mothers and share experiences</p>
                </div>
                <div class="text-center p-6 bg-white rounded-lg shadow">
                    <div class="bg-red-500/10 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-book-medical text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Expert Resources</h3>
                    <p class="text-gray-600 dark:text-gray-300">Access to professional healthcare information and guidance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Team</h2>
            <div class="grid md:grid-cols-5 gap-4">
                <div class="text-center bg-white rounded-lg shadow flex items-center justify-center min-h-[70px] p-3">
                    <h3 class="text-lg font-semibold text-red-500 px-4">Melvin Putra Setiawan</h3>
                </div>
                <div class="text-center bg-white rounded-lg shadow flex items-center justify-center min-h-[70px] p-3">
                    <h3 class="text-lg font-semibold text-red-500 px-4">Bertrand Valentino Wijaya</h3>
                </div>
                <div class="text-center bg-white rounded-lg shadow flex items-center justify-center min-h-[70px] p-3">
                    <h3 class="text-lg font-semibold text-red-500 px-4">Joddy Hartono</h3>
                </div>
                <div class="text-center bg-white rounded-lg shadow flex items-center justify-center min-h-[70px] p-3">
                    <h3 class="text-lg font-semibold text-red-500 px-4">Dean Hans Felandio Setiadi Saputra</h3>
                </div>
                <div class="text-center bg-white rounded-lg shadow flex items-center justify-center min-h-[70px] p-3">
                    <h3 class="text-lg font-semibold text-red-500 px-4">Nathan Widjaja</h3>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
