<div class="bg-white rounded-lg shadowp-4">
    <div class="flex justify-between items-center">
        <h2 class="font-bold text-lg">
            {{ $item->item_name }}
        </h2>
        <span class="text-yellow-500">
            SKU (SKU: {{ $item->sku }})
        </span>
    </div>

    <p class="text-sm text-gray-400 mt-3">
        Quantity: {{ $item->quantity }}
        &middot;
        Unit Price: ${{ number_format($item->unit_price, 2) }}
    </p>

</div>
