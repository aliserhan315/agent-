<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'id' => (string) Str::uuid(),
            'name' => $this->faker->name(),
            'code_name' => $this->faker->unique()->userName(),
            'active' => $this->faker->boolean(90),
        ];
    }
}
