<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CourseType;

class CourseTypeFactory extends Factory
{
    protected $model = CourseType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'learning_outcome' => fake()->paragraph(),
            'template_id' => fake()->optional()->numberBetween(1, 2),
            'back_template_id' => fake()->optional()->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
