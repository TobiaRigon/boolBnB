<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           
            
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'max_guests' => $this->faker->numberBetween(1, 10),
            'rooms' => $this->faker->numberBetween(1, 5),
            'beds' => $this->faker->numberBetween(1, 5),
            'baths' => $this->faker->numberBetween(1, 3),
            'main_img' => $this->faker->imageUrl(),
            'address' => $this->faker->address(),
            'longitude' => $this->faker->longitude(-90, 90),
            'latitude' => $this->faker->latitude(-90, 90),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
