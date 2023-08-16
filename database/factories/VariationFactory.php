<?php

namespace Database\Factories;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Variation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
