<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->count(15)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'surname' => 'Test Surname',
        // ]);

        $this -> call([
            ApartmentTableSeeder::class,
            GalleryTableSeeder::class,
            MessageTableSeeder::class,
            ViewTableSeeder::class,
            ServiceTableSeeder::class,
            ApartmentServiceTableSeeder::class,
            SponsorTableSeeder::class,
            ApartmentSponsorTableSeeder::class,
        ]);
    }
}
