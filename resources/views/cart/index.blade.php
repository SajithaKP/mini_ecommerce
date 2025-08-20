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
    <div class="flex items-center justify-between border-b pb-4 mb-4">
        <div class="flex items-center">
            {{-- ✅ Product Image --}}
            <div class="w-20 h-20 flex-shrink-0 mr-4 bg-gray-100 flex items-center justify-center rounded">
                @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="object-contain max-h-20">
                @else
                    <span class="text-gray-400 text-sm">No Image</span>
                @endif
            </div>

            {{-- ✅ Product Details --}}
            <div>
                <p class="text-lg font-semibold">{{ $item->product->name }}</p>
                <p>₹{{ $item->product->price }} x {{ $item->quantity }}</p>
                <p class="font-semibold">Subtotal: ₹{{ $item->product->price * $item->quantity }}</p>
            </div>
        </div>

        {{-- ✅ Remove Button --}}
        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                Remove
            </button>
        </form>
    </div>
@empty
    <p>Your cart is empty.</p>
@endforelse


                @if ($items->count())
                    <hr class="my-4">
                    <p class="text-xl font-bold">Total: ₹{{ $total }}</p>

                    <form action="{{ route('payment.create') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Buy Now
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
