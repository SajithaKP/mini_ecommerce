{{-- <x-app-layout>
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
</x-app-layout> --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header + Add Product button --}}
                <h3 class="text-lg font-bold mb-4 flex justify-between items-center">
                    Products
                    @if(Auth::check() && Auth::user()->is_admin)
                        <a href="{{ route('products.create') }}" 
                           class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                            + Add Product
                        </a>
                    @endif
                </h3>

                {{-- ✅ Responsive Grid: 1 on mobile, 2 on tablet, 3 on desktop --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @foreach($products as $product)
                        {{-- ✅ Product Card --}}
                        <div class="bg-white border rounded-xl shadow-md flex flex-col justify-between h-full p-4">
                            
                            {{-- Product Image --}}
                            <div class="w-full h-48 flex items-center justify-center mb-4 bg-gray-100 rounded-lg">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="max-h-48 object-contain">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </div>

                            {{-- Product Details --}}
                            <div class="flex-1">
                                <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                                <p class="text-gray-700">₹{{ number_format($product->price, 2) }}</p>
                                <p class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->stock > 0 ? '✅ In Stock' : '❌ Out of Stock' }}
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-4">
                                @if(Auth::check())
                                    @if(Auth::user()->is_admin)
                                        <div class="flex gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="px-3 py-1 bg-yellow-500 text-black rounded hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        @if ($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="number" name="quantity" value="1" min="1" 
                                                       max="{{ $product->stock }}" 
                                                       class="border rounded px-2 py-1 w-16">
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <p class="text-red-500 mt-3">Out of Stock</p>
                                        @endif
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>





