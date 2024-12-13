@extends('layouts.main')

@section('title', 'Order Detail')

@section('content')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mx-auto max-w-5xl">
      <div class="gap-4 sm:flex sm:items-center sm:justify-between">
        @if (auth()->user()->role != "admin");
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
        @else
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">All Orders</h2>
        @endif

        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
          <div>
            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
            <select id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
              <option selected>All orders</option>
              <option value="pre-order">Pre-order</option>
              <option value="transit">In transit</option>
              <option value="confirmed">Confirmed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

        </div>
      </div>

        @if ($orders->isNotEmpty())
            @foreach ($orders as $order)
                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                <a href="#" class="hover:underline">#{{ $order->id }}</a>
                            </dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('d.m.Y') }}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                            @php
                                $total = 10000;
                                foreach ($order->orderDetails as $detail) {
                                    $total += $detail->product->price * $detail->quantity;
                                }
                            @endphp
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                            </dl>

                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                @if ($order->status == "Waiting Payment")
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                        </svg>
                                        Waiting Payment
                                    </dd>
                                @elseif ($order->status == "Processing Order")
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-400 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-primary-900 dark:text-primary-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                        </svg>
                                        Processing Order
                                    </dd>
                                @elseif ($order->status == "Shipping")
                                    <dd class="inline-flex me-2 mt-1.5 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                        </svg>
                                        Shipping
                                    </dd>
                                @elseif ($order->status == "Completed")
                                    <dd class="inline-flex me-2 mt-1.5 items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                        Completed
                                    </dd>
                                @elseif ($order->status == "Cancelled")
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        Cancelled
                                    </dd>
                                @endif
                            </dl>

                            <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                @if ($order->status == "Waiting Payment")
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto text-nowrap">Cancel order</button>
                                    </form>
                                @endif
                                @if ($order->status == "Processing Order" && auth()->user()->role == "admin")
                                    <form action="{{ route('orders.process.deliver', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto text-nowrap">Process & Deliver</button>
                                    </form>
                                @endif
                                @if ($order->status == "Shipping" && auth()->user()->role == "admin")
                                    <form action="{{ route('orders.completed', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-gray-50 bg-green-500 hover:bg-gray-50 hover:text-green-500 focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto text-nowrap">Finish Order</button>
                                    </form>
                                @endif
                                @if ($order->status == "Waiting Payment")
                                    @if(auth()->check() && auth()->user()->id == $order->account_id)
                                        <a href="{{ route('orders.payment', $order->id) }}" class="no-underline w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-red-500 px-3 py-2 text-sm font-medium text-gray-50 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto text-nowrap">Payment</a>
                                    @endif
                                @elseif ($order->status == "Processing Order" || $order->status == "Shipping")
                                    <a href="{{ route('orders.track', $order->id) }}" class="no-underline w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-red-500 px-3 py-2 text-sm font-medium text-gray-50 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto text-nowrap">Track Order</a>
                                @else
                                    <a href="{{ route('orders.track', $order->id) }}" class="no-underline w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-red-500 px-3 py-2 text-sm font-medium text-gray-50 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto text-nowrap">View details</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        @else
            <p>No orders yet...</p>
        @endif


    </div>

    <div class="flex justify-end mt-10 pr-24">
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </div>
  </div>
</section>
@endsection
