<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventoryItemController
 */
final class InventoryItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $inventoryItems = InventoryItem::factory()->count(3)->create();

        $response = $this->get(route('inventory-item.index'));

        $response->assertOk();
        $response->assertViewIs('inventoryItem.index');
        $response->assertViewHas('inventoryItems');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('inventory-item.create'));

        $response->assertOk();
        $response->assertViewIs('inventoryItem.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryItemController::class,
            'store',
            \App\Http\Requests\InventoryItemStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $code = $this->faker->word();
        $description = $this->faker->text();
        $qty = $this->faker->numberBetween(-1000, 1000);
        $price = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $inventory = Inventory::factory()->create();

        $response = $this->post(route('inventory-item.store'), [
            'name' => $name,
            'code' => $code,
            'description' => $description,
            'qty' => $qty,
            'price' => $price,
            'inventory_id' => $inventory->id,
        ]);

        $inventoryItems = InventoryItem::query()
            ->where('name', $name)
            ->where('code', $code)
            ->where('description', $description)
            ->where('qty', $qty)
            ->where('price', $price)
            ->where('inventory_id', $inventory->id)
            ->get();
        $this->assertCount(1, $inventoryItems);
        $inventoryItem = $inventoryItems->first();

        $response->assertRedirect(route('inventory-item.index'));
        $response->assertSessionHas('inventoryItem.id', $inventoryItem->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $inventoryItem = InventoryItem::factory()->create();

        $response = $this->get(route('inventory-item.show', $inventoryItem));

        $response->assertOk();
        $response->assertViewIs('inventoryItem.show');
        $response->assertViewHas('inventoryItem');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $inventoryItem = InventoryItem::factory()->create();

        $response = $this->get(route('inventory-item.edit', $inventoryItem));

        $response->assertOk();
        $response->assertViewIs('inventoryItem.edit');
        $response->assertViewHas('inventoryItem');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryItemController::class,
            'update',
            \App\Http\Requests\InventoryItemUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $inventoryItem = InventoryItem::factory()->create();
        $name = $this->faker->name();
        $code = $this->faker->word();
        $description = $this->faker->text();
        $qty = $this->faker->numberBetween(-1000, 1000);
        $price = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $inventory = Inventory::factory()->create();

        $response = $this->put(route('inventory-item.update', $inventoryItem), [
            'name' => $name,
            'code' => $code,
            'description' => $description,
            'qty' => $qty,
            'price' => $price,
            'inventory_id' => $inventory->id,
        ]);

        $inventoryItem->refresh();

        $response->assertRedirect(route('inventory-item.index'));
        $response->assertSessionHas('inventoryItem.id', $inventoryItem->id);

        $this->assertEquals($name, $inventoryItem->name);
        $this->assertEquals($code, $inventoryItem->code);
        $this->assertEquals($description, $inventoryItem->description);
        $this->assertEquals($qty, $inventoryItem->qty);
        $this->assertEquals($price, $inventoryItem->price);
        $this->assertEquals($inventory->id, $inventoryItem->inventory_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $inventoryItem = InventoryItem::factory()->create();

        $response = $this->delete(route('inventory-item.destroy', $inventoryItem));

        $response->assertRedirect(route('inventory-item.index'));

        $this->assertModelMissing($inventoryItem);
    }
}
