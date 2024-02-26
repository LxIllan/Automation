<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InventoryController
 */
final class InventoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $inventories = Inventory::factory()->count(3)->create();

        $response = $this->get(route('inventory.index'));

        $response->assertOk();
        $response->assertViewIs('inventory.index');
        $response->assertViewHas('inventories');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('inventory.create'));

        $response->assertOk();
        $response->assertViewIs('inventory.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'store',
            \App\Http\Requests\InventoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $description = $this->faker->text();

        $response = $this->post(route('inventory.store'), [
            'name' => $name,
            'description' => $description,
        ]);

        $inventories = Inventory::query()
            ->where('name', $name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $inventories);
        $inventory = $inventories->first();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.show', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.show');
        $response->assertViewHas('inventory');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $inventory = Inventory::factory()->create();

        $response = $this->get(route('inventory.edit', $inventory));

        $response->assertOk();
        $response->assertViewIs('inventory.edit');
        $response->assertViewHas('inventory');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InventoryController::class,
            'update',
            \App\Http\Requests\InventoryUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $inventory = Inventory::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();

        $response = $this->put(route('inventory.update', $inventory), [
            'name' => $name,
            'description' => $description,
        ]);

        $inventory->refresh();

        $response->assertRedirect(route('inventory.index'));
        $response->assertSessionHas('inventory.id', $inventory->id);

        $this->assertEquals($name, $inventory->name);
        $this->assertEquals($description, $inventory->description);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $inventory = Inventory::factory()->create();

        $response = $this->delete(route('inventory.destroy', $inventory));

        $response->assertRedirect(route('inventory.index'));

        $this->assertModelMissing($inventory);
    }
}
