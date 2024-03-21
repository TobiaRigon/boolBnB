<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Apartment;
use App\Models\Sponsor;
use App\Models\ApartmentSponsor;


class ApartmentSponsorTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartmentSponsors = [
            [
                "apartment_id" => "1",
                "sponsor_id" => "3",
            ],
            [
                "apartment_id" => "2",
                "sponsor_id" => "2",
            ],
            [
                "apartment_id" => "3",
                "sponsor_id" => "1",
            ],
            [
                "apartment_id" => "10",
                "sponsor_id" => "1",
            ],
        ];
        foreach ($apartmentSponsors as $apartmentSponsor) {
            $apartment = Apartment::find($apartmentSponsor['apartment_id']);

            // Verifica se c'è già una sponsorizzazione attiva per questo appartamento
            $latestSponsorship = $apartment->sponsors()->latest()->first();
            $currentDate = $latestSponsorship ? Carbon::parse($latestSponsorship->pivot->deadline) : Carbon::now();

            // Calcola la nuova data di scadenza in base all'ID dello sponsor
            $currentDate->addHours($apartmentSponsor['sponsor_id'] == 1 ? 24 : ($apartmentSponsor['sponsor_id'] == 2 ? 72 : 144));

            // Creazione o aggiornamento della relazione appartamento-sponsor
            $apartment->sponsors()->syncWithoutDetaching([$apartmentSponsor['sponsor_id'] => ['deadline' => $currentDate]]);

            // Aggiornamento del campo in_evidence dell'appartamento
            $apartment->in_evidence = true;
            $apartment->save();
        }
    }

}
