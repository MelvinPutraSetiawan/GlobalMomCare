@extends('layouts.main')

@section('title', 'Track Product')

@section('content')

{{-- Count Total --}}
@php
    $delivery = 10000;
    $subtotal = 0;
    if($orders->orderDetails->isNotEmpty()){
        foreach ($orders->orderDetails as $detail) {
            $subtotal += $detail->product->price * $detail->quantity;
        }
    }
    $tax = 0.1 * $subtotal;
    $total = $subtotal+$delivery;
@endphp
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="flex gap-4 items-center justify-start">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Track the delivery of order #{{ $orders->id }}</h2>
        @if ($orders->status == "Cancelled")
            <span class="mb-2 px-3 py-2 bg-red-500 text-white rounded-lg font-bold">{{ $orders->status }}</span>
        @elseif ($orders->status == "Completed")
            <span class="mb-2 px-3 py-2 bg-green-500 text-white rounded-lg font-bold">{{ $orders->status }}</span>
        @else
            <span class="mb-2 px-3 py-2 bg-blue-500 text-white rounded-lg font-bold">{{ $orders->status }}</span>
        @endif
    </div>

    <div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
      <div class="w-full divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 dark:divide-gray-700 dark:border-gray-700 lg:max-w-xl xl:max-w-2xl">

        @if ($orders->orderDetails->isNotEmpty())
            @foreach ($orders->orderDetails as $order)
                <div class="space-y-4 p-6">
                    <div class="flex items-center gap-6">
                        <a href="{{ route('products.show', $order->product->id) }}" class="h-14 w-14 shrink-0">
                            @if($order->product->pictures->isNotEmpty())
                                <img src="{{ asset('storage/' . $order->product->pictures->first()->pictureLink) }}" alt="{{ $order->product->name }}" class="w-14 h-14 object-cover rounded">
                            @else
                                <div class="bg-gray-200 w-14 h-14 flex items-center justify-center rounded">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>

                        <a href="{{ route('products.show', $order->product->id) }}" class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white">{{ $order->product->name }}</a>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Product ID:</span> {{ $order->product->id }}</p>

                        <div class="flex items-center justify-end gap-4">
                        <p class="text-base font-normal text-gray-900 dark:text-white">x{{ $order->quantity }}</p>

                        <p class="text-xl font-bold leading-tight text-gray-900 dark:text-white">Rp. {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        <div class="h-full space-y-4 bg-gray-50 p-6 dark:bg-gray-800">
            <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                <dd class="font-medium text-gray-900 dark:text-white">Rp. {{ number_format($subtotal, 0, ',', '.') }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
                <dd class="font-medium text-gray-900 dark:text-white">Rp. {{ number_format($tax, 0, ',', '.') }}</dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                <dt class="font-normal text-gray-500 dark:text-gray-400">Delivery</dt>
                <dd class="font-medium text-gray-900 dark:text-white">Rp. {{ number_format($delivery, 0, ',', '.') }}</dd>
                </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp. {{ number_format($total, 0, ',', '.') }}</dd>
            </dl>
        </div>


      </div>

      <div class="mt-6 grow sm:mt-8 lg:mt-0">
        <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            {{-- order history --}}
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Order history</h3>

            <ol class="relative pl-0 pr-5 ms-3 border-s border-gray-200 dark:border-gray-700">
                <!-- Arrival Time -->
                <li class="mb-10 ms-6 relative">
                @if ($orders->status == "Processing Order" || $orders->status == "Shipping")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                        </svg>
                    </span>
                    @if ($orders->status == "Shipping")
                        <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    @else
                        <div class="absolute left-3 top-8 w-px h-full bg-gray-300 dark:bg-gray-700"></div>
                    @endif
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Estimated arrival time {{ $orders->arrive->format('d M Y') }}</h4>
                    <p class="ml-10 text-sm font-normal text-gray-500 dark:text-gray-400">Waiting product to arrive on destination</p>
                @elseif($orders->status != "Cancelled")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-blue-700 dark:text-blue-500">{{ $orders->arrive->format('d M Y, H:i') }}</h4>
                    <p class="ml-10 mb-0 text-wrap text-sm text-blue-700 dark:text-blue-500">Ordered has arrived at the destination</p>
                    <p class="ml-10 text-wrap text-sm text-blue-700 dark:text-blue-500">({{ $orders->account->address }})</p>
                @endif

                <!-- Delivering -->
                <li class="mb-10 ms-6 relative">
                @if ($orders->status == "Processing Order")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-gray-300 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Estimated delivery time {{ $orders->deliver->format('d M Y') }}</h4>
                    <p class="ml-10 text-sm font-normal text-gray-500 dark:text-gray-400">Waiting product to be delivered</p>
                @elseif($orders->status != "Cancelled")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-blue-700 dark:text-blue-500">{{ $orders->processing->format('d M Y, H:i') }}</h4>
                    <p class="ml-10 text-sm text-blue-700 dark:text-blue-500">Ordered Being Delivered</p>
                @endif

                <!-- Processing -->
                <li class="mb-10 ms-6 relative">
                @if ($orders->status == "Processing Order")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z"/>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                            <line x1="12" y1="22.08" x2="12" y2="12"/>
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Estimated processing time {{ $orders->processing->format('d M Y') }}</h4>
                    <p class="ml-10 text-sm font-normal text-gray-500 dark:text-gray-400">Products being process</p>
                @elseif($orders->status != "Cancelled")
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold text-blue-700 dark:text-blue-500">{{ $orders->processing->format('d M Y, H:i') }}</h4>
                    <p class="ml-10 text-sm text-blue-700 dark:text-blue-500">Order ready for delivery</p>
                @endif
                </li>

                {{-- Payment --}}
                @if($orders->status != "Cancelled")
                    <li class="mb-10 ms-6 relative text-blue-700 dark:text-blue-500">
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-blue-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold">{{ $orders->payment->format('d M Y, H:i') }}</h4>
                    <p class="ml-10 text-sm">Payment Completed</p>
                    </li>
                @else
                    <li class="mb-10 ms-6 relative text-red-700 dark:text-red-500">
                    <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-red-100 ring-8 ring-white dark:bg-red-900 dark:ring-gray-800">
                        <svg class="h-4 w-4 text-red-500 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </span>
                    <div class="absolute left-3 top-8 w-px h-full bg-red-500 dark:bg-gray-700"></div>
                    <h4 class="ml-10 mb-0.5 text-base font-semibold">Cancelled</h4>
                    <p class="ml-10 text-sm">Order Cancelled</p>
                    </li>
                @endif

                {{-- Created Order --}}
                <li class="mb-10 ms-6 relative text-blue-700 dark:text-blue-500">
                <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                    </svg>
                </span>
                <h4 class="ml-10 mb-0.5 text-base font-semibold">{{ $orders->created_at->format('d M Y, H:i') }}</h4>
                <p class="ml-10 text-sm">Order created</p>
                </li>
            </ol>
            <div class="gap-4 sm:flex sm:items-center">
                <a href="{{ route('orders.index', auth()->id()) }}" class="no-underline text-nowrap w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Back to Order</a>
                <a href="{{ route('carts.index', auth()->id()) }}" class="no-underline flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:mt-0">View Cart</a>
            </div>
        </div>
        {{-- ======================================= --}}
      </div>
    </div>
  </div>
</section>
@endsection
