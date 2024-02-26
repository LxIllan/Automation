<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PieceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PieceCategoryController
 */
final class PieceCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pieceCategories = PieceCategory::factory()->count(3)->create();

        $response = $this->get(route('piece-category.index'));

        $response->assertOk();
        $response->assertViewIs('pieceCategory.index');
        $response->assertViewHas('pieceCategories');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('piece-category.create'));

        $response->assertOk();
        $response->assertViewIs('pieceCategory.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PieceCategoryController::class,
            'store',
            \App\Http\Requests\PieceCategoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('piece-category.store'), [
            'name' => $name,
        ]);

        $pieceCategories = PieceCategory::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $pieceCategories);
        $pieceCategory = $pieceCategories->first();

        $response->assertRedirect(route('piece-category.index'));
        $response->assertSessionHas('pieceCategory.id', $pieceCategory->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $pieceCategory = PieceCategory::factory()->create();

        $response = $this->get(route('piece-category.show', $pieceCategory));

        $response->assertOk();
        $response->assertViewIs('pieceCategory.show');
        $response->assertViewHas('pieceCategory');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $pieceCategory = PieceCategory::factory()->create();

        $response = $this->get(route('piece-category.edit', $pieceCategory));

        $response->assertOk();
        $response->assertViewIs('pieceCategory.edit');
        $response->assertViewHas('pieceCategory');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PieceCategoryController::class,
            'update',
            \App\Http\Requests\PieceCategoryUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $pieceCategory = PieceCategory::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('piece-category.update', $pieceCategory), [
            'name' => $name,
        ]);

        $pieceCategory->refresh();

        $response->assertRedirect(route('piece-category.index'));
        $response->assertSessionHas('pieceCategory.id', $pieceCategory->id);

        $this->assertEquals($name, $pieceCategory->name);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $pieceCategory = PieceCategory::factory()->create();

        $response = $this->delete(route('piece-category.destroy', $pieceCategory));

        $response->assertRedirect(route('piece-category.index'));

        $this->assertModelMissing($pieceCategory);
    }
}
