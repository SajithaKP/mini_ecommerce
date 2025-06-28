
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Products</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <div class="border p-4 rounded shadow">
                            <h4 class="font-semibold">{{ $product->name }}</h4>
                            <p>Price: ₹{{ $product->price }}</p>
                            <p>Stock: {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</p>

                            @if ($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded px-2 py-1 w-16">
                                    <button type="submit" class="ml-2 px-4 py-1 bg-blue-500 text-white rounded">Add to Cart</button>
                                </form>
                            @else
                                <p class="text-red-500">Out of Stock</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
