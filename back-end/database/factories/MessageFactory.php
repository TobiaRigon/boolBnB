<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'sender_text' => $this -> faker -> text(),
           'data' => $this -> faker -> date(),
           'sender_mail' => $this -> faker -> email(),
           'sender_name' => $this -> faker -> name(),
           'sender_surname' => $this -> faker -> name(),
           
        ];
    }
}
