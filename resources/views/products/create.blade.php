<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" class="border rounded w-full p-2" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Price</label>
                        <input type="number" step="0.01" name="price" class="border rounded w-full p-2" value="{{ old('price') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Stock</label>
                        <input type="number" name="stock" class="border rounded w-full p-2" value="{{ old('stock') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" class="border rounded w-full p-2">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Product Image</label>
                        <input type="file" name="image" class="border rounded w-full p-2" accept="image/*">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
