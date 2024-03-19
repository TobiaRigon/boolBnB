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
         // Retrieve all apartments and sponsors
         $apartments = Apartment::all();
         $sponsors = Sponsor::all();

         // Loop through each apartment
         foreach ($apartments as $apartment) {
             // Choose a random sponsor for the apartment
             $randomSponsor = $sponsors->random();

             // Attach the sponsor to the apartment
             $apartment->sponsors()->attach($randomSponsor);
         }
    }
}
