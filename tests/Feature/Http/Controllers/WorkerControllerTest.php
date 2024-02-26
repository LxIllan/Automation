<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WorkerController
 */
final class WorkerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $workers = Worker::factory()->count(3)->create();

        $response = $this->get(route('worker.index'));

        $response->assertOk();
        $response->assertViewIs('worker.index');
        $response->assertViewHas('workers');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('worker.create'));

        $response->assertOk();
        $response->assertViewIs('worker.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkerController::class,
            'store',
            \App\Http\Requests\WorkerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $last_name = $this->faker->lastName();

        $response = $this->post(route('worker.store'), [
            'name' => $name,
            'last_name' => $last_name,
        ]);

        $workers = Worker::query()
            ->where('name', $name)
            ->where('last_name', $last_name)
            ->get();
        $this->assertCount(1, $workers);
        $worker = $workers->first();

        $response->assertRedirect(route('worker.index'));
        $response->assertSessionHas('worker.id', $worker->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $worker = Worker::factory()->create();

        $response = $this->get(route('worker.show', $worker));

        $response->assertOk();
        $response->assertViewIs('worker.show');
        $response->assertViewHas('worker');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $worker = Worker::factory()->create();

        $response = $this->get(route('worker.edit', $worker));

        $response->assertOk();
        $response->assertViewIs('worker.edit');
        $response->assertViewHas('worker');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WorkerController::class,
            'update',
            \App\Http\Requests\WorkerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $worker = Worker::factory()->create();
        $name = $this->faker->name();
        $last_name = $this->faker->lastName();

        $response = $this->put(route('worker.update', $worker), [
            'name' => $name,
            'last_name' => $last_name,
        ]);

        $worker->refresh();

        $response->assertRedirect(route('worker.index'));
        $response->assertSessionHas('worker.id', $worker->id);

        $this->assertEquals($name, $worker->name);
        $this->assertEquals($last_name, $worker->last_name);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $worker = Worker::factory()->create();

        $response = $this->delete(route('worker.destroy', $worker));

        $response->assertRedirect(route('worker.index'));

        $this->assertModelMissing($worker);
    }
}
