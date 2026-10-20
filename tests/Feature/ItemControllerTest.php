<?php

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->use(RefreshDatabase::class);

describe('editing items', function () {
    test('shows the current item values in the edit form', function () {
        $item = Item::create([
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);

        $response = $this->get(route('items.edit', $item));

        $response->assertOk()
            ->assertViewIs('items.edit')
            ->assertSee('value="Desk Lamp"', false)
            ->assertSee('value="LAMP-001"', false)
            ->assertSee('value="8"', false)
            ->assertSee('value="24.50"', false);
    });

    test('updates item values while keeping its existing sku', function () {
        $item = Item::create([
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);

        $response = $this->put(route('items.update', $item), [
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 12,
            'unit_price' => 29.95,
        ]);

        $response->assertRedirectToRoute('items.index')
            ->assertSessionHas('success', 'Item updated successfully.');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 12,
            'unit_price' => 29.95,
        ]);
    });

    test('rejects another items sku and leaves the item unchanged', function () {
        $item = Item::create([
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);

        Item::create([
            'item_name' => 'Floor Lamp',
            'sku' => 'LAMP-002',
            'quantity' => 3,
            'unit_price' => 59.00,
        ]);

        $response = $this->from(route('items.edit', $item))
            ->put(route('items.update', $item), [
                'item_name' => 'Changed Lamp',
                'sku' => 'LAMP-002',
                'quantity' => 15,
                'unit_price' => 30.00,
            ]);

        $response->assertRedirectToRoute('items.edit', $item)
            ->assertSessionHasErrors('sku');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);
    });

    test('rejects invalid values and returns them to the edit form', function () {
        $item = Item::create([
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);

        $response = $this->from(route('items.edit', $item))
            ->put(route('items.update', $item), [
                'item_name' => '',
                'sku' => 'LAMP-001',
                'quantity' => -3,
                'unit_price' => 24.50,
            ]);

        $response->assertRedirectToRoute('items.edit', $item)
            ->assertSessionHasErrors(['item_name', 'quantity']);

        $this->get(route('items.edit', $item))
            ->assertOk()
            ->assertSee('value=""', false)
            ->assertSee('value="-3"', false);

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'item_name' => 'Desk Lamp',
            'quantity' => 8,
        ]);
    });

    test('deletes an item', function () {
        $item = Item::create([
            'item_name' => 'Desk Lamp',
            'sku' => 'LAMP-001',
            'quantity' => 8,
            'unit_price' => 24.50,
        ]);

        $response = $this->delete(route('items.destroy', $item));

        $response->assertRedirectToRoute('items.index')
            ->assertSessionHas('success', 'Item deleted.');

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    });

    test('returns not found for an item that does not exist', function () {
        $this->get('/items/9999/edit')->assertNotFound();
    });
});
