<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'serial_number' => $this->faker->ean13(),
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'type' => $this->faker->word(),
            'category_id' => rand(1, 2),
            'status_id' => rand(1,4),
            'explanation' => $this->faker->sentences(3, true),
            'date_of_entry' => $this->faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null),
            'quantity' => $this->faker->numberBetween(100, 1000)
        ];
    }
}
