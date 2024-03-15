<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\Service;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Recupera tutti gli appartamenti e tutti i servizi
    $apartments = Apartment::all();
    $services = Service::all();

    // Associa casualmente i servizi a ciascun appartamento
    $apartments->each(function ($apartment) use ($services) {
        // Seleziona un numero casuale di servizi da associare all'appartamento,
        // garantendo che sia almeno 2
        $numServices = max(2, rand(1, count($services)));

        // Prendi un insieme casuale di servizi
        $randomServices = $services->random($numServices);

        // Associare i servizi selezionati all'appartamento
        $apartment->services()->attach($randomServices);
    });
}

}
