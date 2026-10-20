<x-layout>
    <section class="space-y-6">
        <header>
            <h1 class="text-2xl font-bold text-gray-900">Edit Item</h1>
            <p class="mt-1 text-sm text-gray-600">Update the item details below.</p>
        </header>

        <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-4 rounded-lg bg-white p-5 shadow">
            @csrf
            @method('PUT')

            <div>
                <label for="item_name" class="block text-sm font-medium text-gray-700">Item name</label>
                <input id="item_name" name="item_name" type="text" maxlength="255" required value="{{ old('item_name', $item->item_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('item_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                <input id="sku" name="sku" type="text" maxlength="50" required value="{{ old('sku', $item->sku) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('sku')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="0" step="1" required value="{{ old('quantity', $item->quantity) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('quantity')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="unit_price" class="block text-sm font-medium text-gray-700">Unit price</label>
                <input id="unit_price" name="unit_price" type="number" min="0" step="0.01" required value="{{ old('unit_price', $item->unit_price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('unit_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 font-medium text-white hover:bg-indigo-700">
                    Update Item
                </button>
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
            </div>
        </form>
    </section>
</x-layout>
