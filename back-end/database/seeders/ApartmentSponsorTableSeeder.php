<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\Sponsor;


class ApartmentSponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment:: all() // prendimi tutti gli appartamenti creati
        ->each (function($apartment){
            $sponsor_id= Sponsor :: inRandomOrder() -> take(rand(1,10)) -> pluck('id');

            $apartment -> sponsors() -> attach($sponsor_id);

        });
    }
}
