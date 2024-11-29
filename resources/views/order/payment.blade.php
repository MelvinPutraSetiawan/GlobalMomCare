@extends('layouts.main')

@section('title', 'Payment')

@section('content')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <form method="POST" action="{{ route('orders.process.payment', $orders->id) }}" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    @csrf
    {{-- Progress Bar --}}
    <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
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
        <hr class="border-gray-500 w-full mx-3 border-2">
      </li>

      <li class="flex shrink-0 items-center text-nowrap">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Order summary
      </li>
    </ol>

    {{-- Delivery Detail --}}
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <div class="min-w-0 flex-1 space-y-8">
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Details</h2>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="your_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Name* </label>
              <input name="name" value="{{ old('content', $user->name) }}" type="text" id="your_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="John Doe" required />
            </div>

            <div>
              <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Email* </label>
              <input name="email" value="{{ old('content', $user->email) }}" type="email" id="your_email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="john@example.com" required />
            </div>
          </div>

            <div>
              <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Address* </label>
              <input name="address" value="{{ old('content', $user->address) }}" type="text" id="your_email" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="City, Street, Country, ..." required />
            </div>

        </div>

        {{-- Payment --}}
        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment</h3>

          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="credit-card" aria-describedby="credit-card-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" checked />
                </div>

                <div class="ms-4 text-sm">
                  <label for="credit-card" class="font-medium leading-none text-gray-900 dark:text-white"> Credit Card </label>
                  <p id="credit-card-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pay with your credit card</p>
                </div>
              </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="pay-on-delivery" aria-describedby="pay-on-delivery-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                </div>

                <div class="ms-4 text-sm">
                  <label for="pay-on-delivery" class="font-medium leading-none text-gray-900 dark:text-white"> Payment on delivery </label>
                  <p id="pay-on-delivery-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pay after recieving the items</p>
                </div>
              </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="paypal-2" aria-describedby="paypal-text" type="radio" name="payment-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                </div>

                <div class="ms-4 text-sm">
                  <label for="paypal-2" class="font-medium leading-none text-gray-900 dark:text-white"> Paypal account </label>
                  <p id="paypal-text" class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Connect to your account</p>
                </div>
              </div>
            </div>
          </div>
        </div>


        {{-- Product Detail --}}
        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Product(s)</h3>
            @if ($orders->orderDetails->isNotEmpty())
                @foreach ($orders->orderDetails as $order)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="{{ route('products.show', $order->product->id) }}" class="shrink-0 md:order-1">
                            @if($order->product->pictures->isNotEmpty())
                                <img src="{{ asset('storage/' . $order->product->pictures->first()->pictureLink) }}" alt="{{ $order->product->name }}" class="w-40 h-32 object-cover rounded">
                            @else
                                <div class="bg-gray-200 w-full h-32 flex items-center justify-center rounded">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>

                        <label for="counter-input" class="sr-only">Choose quantity:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                            <p class="ml-3 mr-4 w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white">x{{ $order->quantity }}</p>
                            <p data-price-display class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                            <a href="{{ route('products.show', $order->product->id) }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $order->product->name }}</a>
                        </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

      </div>

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

      <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
        <div class="flow-root">
          <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($subtotal, 0, ',', '.') }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($tax, 0, ',', '.') }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Delivery</dt>
              <dd class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($delivery, 0, ',', '.') }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-white">Rp. {{ number_format($total, 0, ',', '.') }}</dd>
            </dl>
          </div>
        </div>
        <div class="space-y-3">
          <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-red-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirm Payment</button>
        </div>

      </div>
    </div>
  </form>
</section>

@endsection
