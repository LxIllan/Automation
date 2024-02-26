<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProjectController
 */
final class ProjectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $projects = Project::factory()->count(3)->create();

        $response = $this->get(route('project.index'));

        $response->assertOk();
        $response->assertViewIs('project.index');
        $response->assertViewHas('projects');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('project.create'));

        $response->assertOk();
        $response->assertViewIs('project.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'store',
            \App\Http\Requests\ProjectStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $description = $this->faker->text();
        $customer = Customer::factory()->create();

        $response = $this->post(route('project.store'), [
            'name' => $name,
            'description' => $description,
            'customer_id' => $customer->id,
        ]);

        $projects = Project::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('customer_id', $customer->id)
            ->get();
        $this->assertCount(1, $projects);
        $project = $projects->first();

        $response->assertRedirect(route('project.index'));
        $response->assertSessionHas('project.id', $project->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $project = Project::factory()->create();

        $response = $this->get(route('project.show', $project));

        $response->assertOk();
        $response->assertViewIs('project.show');
        $response->assertViewHas('project');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $project = Project::factory()->create();

        $response = $this->get(route('project.edit', $project));

        $response->assertOk();
        $response->assertViewIs('project.edit');
        $response->assertViewHas('project');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'update',
            \App\Http\Requests\ProjectUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $project = Project::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $customer = Customer::factory()->create();

        $response = $this->put(route('project.update', $project), [
            'name' => $name,
            'description' => $description,
            'customer_id' => $customer->id,
        ]);

        $project->refresh();

        $response->assertRedirect(route('project.index'));
        $response->assertSessionHas('project.id', $project->id);

        $this->assertEquals($name, $project->name);
        $this->assertEquals($description, $project->description);
        $this->assertEquals($customer->id, $project->customer_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('project.destroy', $project));

        $response->assertRedirect(route('project.index'));

        $this->assertModelMissing($project);
    }
}
