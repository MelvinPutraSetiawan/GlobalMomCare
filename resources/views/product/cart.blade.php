@extends('layouts.main')

@section('title', 'Cart')

@section('content')
<form class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16" action="{{ route('orders.store') }}" method="POST">
    @csrf
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
      <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
        <div class="space-y-6">

            @if ($carts->isNotEmpty())
                @foreach ($carts as $cart)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="{{ route('products.show', $cart->product->id) }}" class="shrink-0 md:order-1">
                            @if($cart->product->pictures->isNotEmpty())
                                <img src="{{ asset('storage/' . $cart->product->pictures->first()->pictureLink) }}" alt="{{ $cart->product->name }}" class="w-40 h-32 object-cover rounded">
                            @else
                                <div class="bg-gray-200 w-full h-32 flex items-center justify-center rounded">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>

                        <label for="counter-input" class="sr-only">Choose quantity:</label>
                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                            <div class="flex items-center">
                            <button type="button" data-decrement class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                </svg>
                            </button>
                            <input name="carts[{{ $loop->index }}][quantity]" type="number" data-quantity data-product-id="{{ $cart->product->id }}" data-price="{{ $cart->product->price }}" min="1" max="{{ $cart->product->stock }}" value="1" class="ml-3 w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" />
                            <button type="button" data-increment class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                            </div>
                            <div class="text-end md:order-4 md:w-32 mt-3">
                            <p data-price-display class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                            <input type="hidden" name="carts[{{ $loop->index }}][product_id]" value="{{ $cart->product->id }}">
                            <a href="{{ route('products.show', $cart->product->id) }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cart->product->name }}</a>

                            <div class="flex items-center gap-4">
                            <button type="button" onclick="deleteCartItem({{ $cart->id }})" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                                Remove
                            </button>

                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No items...</p>
            @endif

        </div>
      </div>

      <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
        <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
          <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

          <div class="space-y-4">
            <div class="space-y-2">
              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Price</dt>
                <dd id="total-price" class="text-base font-medium text-gray-900 dark:text-white">Rp 0</dd>
              </dl>

              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
                <dd id="tax" class="text-base font-medium text-gray-900 dark:text-white">Rp 0</dd>
              </dl>

              <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Delivery</dt>
                <dd id="delivery-fee" class="text-base font-medium text-gray-900 dark:text-white">Rp 0</dd>
              </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
              <dt class="text-base font-bold text-gray-900 dark:text-white">Grand Total</dt>
              <dd id="grand-total" class="text-base font-bold text-gray-900 dark:text-white">Rp 0</dd>
            </dl>
          </div>

          @if ($carts->isNotEmpty())
            <button type="submit" class="flex no-underline w-full items-center justify-center rounded-lg bg-red-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4">
                Proceed to Checkout
            </button>
          @else
            <p class="cursor-pointer flex no-underline w-full items-center justify-center rounded-lg bg-red-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4">
                No Items to Checkout
            </p>
          @endif

          <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="{{ route('products.index') }}" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 no-underline hover:underline dark:text-primary-500">
              Back to Products
              <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const updateOrderSummary = () => {
        let totalPrice = 0;
        const deliveryFee = 10000;
        document.querySelectorAll("[data-quantity]").forEach(input => {
            const quantity = parseInt(input.value);
            const price = parseInt(input.getAttribute("data-price"));
            totalPrice += quantity * price;
        });

        const tax = Math.round(totalPrice * 0.10);

        document.getElementById("total-price").innerText = `Rp ${totalPrice.toLocaleString()}`;
        document.getElementById("tax").innerText = `Rp ${tax.toLocaleString()}`;
        document.getElementById("delivery-fee").innerText = `Rp ${deliveryFee.toLocaleString()}`;
        document.getElementById("grand-total").innerText = `Rp ${(totalPrice + tax + deliveryFee).toLocaleString()}`;
    };

    document.querySelectorAll("[data-increment]").forEach(button => {
        button.addEventListener("click", () => {
            const input = button.previousElementSibling;
            const currentValue = parseInt(input.value);
            const max = parseInt(input.max);

            if (currentValue < max) {
                input.value = currentValue + 1;
                updateOrderSummary();
            }
        });
    });

    document.querySelectorAll("[data-decrement]").forEach(button => {
        button.addEventListener("click", () => {
            const input = button.nextElementSibling;
            const currentValue = parseInt(input.value);
            const min = parseInt(input.min);

            if (currentValue > min) {
                input.value = currentValue - 1;
                updateOrderSummary();
            }
        });
    });

    document.querySelectorAll("[data-quantity]").forEach(input => {
        input.addEventListener("input", () => {
            if (input.value < input.min) input.value = input.min;
            if (input.value > input.max) input.value = input.max;
            updateOrderSummary();
        });
    });

    updateOrderSummary();
});

function deleteCartItem(cartId) {
    if (confirm('Are you sure you want to remove this item from the cart?')) {
        fetch(`{{ url('/cart/delete') }}/${cartId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            }
        })
    }
}



</script>
@endsection
