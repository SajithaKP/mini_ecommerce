<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                @forelse ($items as $item)
                    <div class="border-b pb-2 mb-2">
                        <p class="text-lg font-semibold">{{ $item->product->name }}</p>
                        <p>₹{{ $item->product->price }} x {{ $item->quantity }}</p>
                        <p>Subtotal: ₹{{ $item->product->price * $item->quantity }}</p>
                    </div>
                @empty
                    <p>Your cart is empty.</p>
                @endforelse

                @if ($items->count())
                    <hr class="my-4">
                    <p class="text-xl font-bold">Total: ₹{{ $total }}</p>

                    <form action="{{ route('cart.buy') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Buy Now
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
