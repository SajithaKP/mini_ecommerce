<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                               class="border border-gray-300 rounded px-3 py-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Price (₹)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                               class="border border-gray-300 rounded px-3 py-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                               class="border border-gray-300 rounded px-3 py-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="border border-gray-300 rounded px-3 py-2 w-full">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Product Image</label>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="mb-2 w-32 h-32 object-cover">
                        @endif
                        <input type="file" name="image" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Update Product
                        </button>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
