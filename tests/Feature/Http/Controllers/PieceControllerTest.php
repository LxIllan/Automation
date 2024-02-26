<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Piece;
use App\Models\PieceCategory;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PieceController
 */
final class PieceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pieces = Piece::factory()->count(3)->create();

        $response = $this->get(route('piece.index'));

        $response->assertOk();
        $response->assertViewIs('piece.index');
        $response->assertViewHas('pieces');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('piece.create'));

        $response->assertOk();
        $response->assertViewIs('piece.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PieceController::class,
            'store',
            \App\Http\Requests\PieceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $description = $this->faker->text();
        $qty = $this->faker->numberBetween(-8, 8);
        $hours = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $status = $this->faker->randomElement(
            /** enum_attributes **/
        );
        $project = Project::factory()->create();
        $worker = Worker::factory()->create();
        $piece_category = PieceCategory::factory()->create();

        $response = $this->post(route('piece.store'), [
            'name' => $name,
            'description' => $description,
            'qty' => $qty,
            'hours' => $hours,
            'status' => $status,
            'project_id' => $project->id,
            'worker_id' => $worker->id,
            'piece_category_id' => $piece_category->id,
        ]);

        $pieces = Piece::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('qty', $qty)
            ->where('hours', $hours)
            ->where('status', $status)
            ->where('project_id', $project->id)
            ->where('worker_id', $worker->id)
            ->where('piece_category_id', $piece_category->id)
            ->get();
        $this->assertCount(1, $pieces);
        $piece = $pieces->first();

        $response->assertRedirect(route('piece.index'));
        $response->assertSessionHas('piece.id', $piece->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $piece = Piece::factory()->create();

        $response = $this->get(route('piece.show', $piece));

        $response->assertOk();
        $response->assertViewIs('piece.show');
        $response->assertViewHas('piece');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $piece = Piece::factory()->create();

        $response = $this->get(route('piece.edit', $piece));

        $response->assertOk();
        $response->assertViewIs('piece.edit');
        $response->assertViewHas('piece');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PieceController::class,
            'update',
            \App\Http\Requests\PieceUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $piece = Piece::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $qty = $this->faker->numberBetween(-8, 8);
        $hours = $this->faker->randomFloat(
            /** float_attributes **/
        );
        $status = $this->faker->randomElement(
            /** enum_attributes **/
        );
        $project = Project::factory()->create();
        $worker = Worker::factory()->create();
        $piece_category = PieceCategory::factory()->create();

        $response = $this->put(route('piece.update', $piece), [
            'name' => $name,
            'description' => $description,
            'qty' => $qty,
            'hours' => $hours,
            'status' => $status,
            'project_id' => $project->id,
            'worker_id' => $worker->id,
            'piece_category_id' => $piece_category->id,
        ]);

        $piece->refresh();

        $response->assertRedirect(route('piece.index'));
        $response->assertSessionHas('piece.id', $piece->id);

        $this->assertEquals($name, $piece->name);
        $this->assertEquals($description, $piece->description);
        $this->assertEquals($qty, $piece->qty);
        $this->assertEquals($hours, $piece->hours);
        $this->assertEquals($status, $piece->status);
        $this->assertEquals($project->id, $piece->project_id);
        $this->assertEquals($worker->id, $piece->worker_id);
        $this->assertEquals($piece_category->id, $piece->piece_category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $piece = Piece::factory()->create();

        $response = $this->delete(route('piece.destroy', $piece));

        $response->assertRedirect(route('piece.index'));

        $this->assertModelMissing($piece);
    }
}
