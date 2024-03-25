<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\View;
use App\Models\Apartment;
use Faker\Generator as Faker;
class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
{
    // Check if there are any apartments available
    $apartmentsCount = Apartment::count();

    if ($apartmentsCount === 0) {
        // Handle the case where there are no apartments
        // You can choose to throw an exception, log a message, or handle it in any way you prefer
        return;
    }

    for ($i = 0; $i < 4000; $i++) {
        // Fetch a random apartment ID
        $apartment_id = Apartment::inRandomOrder()->first()->id;

        // Generate view data
        $view = [
            "apartment_id" => $apartment_id,
            "ip_address" => $faker->ipv4(),
            "date" => $faker->dateTimeBetween('-4 months', '-1 days')->format('Y-m-d H:i:s'),
            "created_at" => $faker->dateTimeBetween('-4 months', '-1 days')
        ];

        // Create view record
        View::create($view);
    }
}
}
