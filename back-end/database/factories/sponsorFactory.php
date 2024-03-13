<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class sponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
                'title' => $this -> faker -> title(),
                'description' => $this -> faker -> sentence(),
                'duration' => $this -> faker -> numberBetween(1, 5),
                'price' => $this -> faker -> randomFloat(2, 0, 9999)    
        ];
    }
}
