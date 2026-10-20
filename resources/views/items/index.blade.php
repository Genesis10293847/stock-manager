<x-layout>
    <section class="space-y-6">
        <header>
            <h1 class="text-2xl font-bold text-gray-900">Stock Items</h1>
            <p class="mt-1 text-sm text-gray-600">Add an item or review current stock.</p>
        </header>

        @if (session('status'))
            <p role="status" class="rounded-md bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('status') }}
            </p>
        @endif
        @if (session('success'))
            <p role="status" class="rounded-md bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </p>
        @endif

        <form method="POST" action="{{ route('items.store') }}" class="space-y-4 rounded-lg bg-white p-5 shadow">
            @csrf

            <div>
                <label for="item_name" class="block text-sm font-medium text-gray-700">Item name</label>
                <input id="item_name" name="item_name" type="text" maxlength="255" required value="{{ old('item_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('item_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                <input id="sku" name="sku" type="text" maxlength="50" required value="{{ old('sku') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('sku')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="0" step="1" required value="{{ old('quantity', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('quantity')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="unit_price" class="block text-sm font-medium text-gray-700">Unit price</label>
                <input id="unit_price" name="unit_price" type="number" min="0" step="0.01" required value="{{ old('unit_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('unit_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 font-medium text-white hover:bg-indigo-700">
                Add item
            </button>
        </form>

        <section aria-labelledby="items-heading">
            <h2 id="items-heading" class="mb-3 text-lg font-semibold text-gray-900">Inventory</h2>
            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="w-full text-left text-sm">
                    <thead class="border-b bg-gray-50 text-gray-700">
                        <tr>
                            <th scope="col" class="px-4 py-3">Item name</th>
                            <th scope="col" class="px-4 py-3">SKU</th>
                            <th scope="col" class="px-4 py-3">Quantity</th>
                            <th scope="col" class="px-4 py-3">Unit price</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($items as $item)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $item->item_name }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $item->sku }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-gray-700">${{ number_format((float) $item->unit_price, 2) }}</td>
                                <td class="px-4 py-3 text-gray-700">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('items.edit', $item) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                                        <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">No items have been added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </section>
</x-layout>