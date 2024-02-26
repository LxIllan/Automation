<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Piece;
use App\Models\PieceCategory;
use App\Models\Project;
use App\Models\Worker;

class PieceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Piece::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'qty' => $this->faker->randomDigitNotNull(),
            'hours' => $this->faker->randomFloat(0, 0, 99999.),
            'status' => "Pedido",
            'project_id' => Project::factory(),
            'worker_id' => Worker::factory(),
            'piece_category_id' => PieceCategory::factory(),
        ];
    }
}
