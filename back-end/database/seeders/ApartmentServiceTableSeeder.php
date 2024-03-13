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
        Apartment:: all() // prendimi tutti gli appartamenti creati
        ->each (function($apartment){
            $service_id= Service :: inRandomOrder() -> take(rand(1,10)) -> pluck('id');

            $apartment -> services() -> attach($service_id);

        });
        // Apartment :: factory()
        // -> count(5)
        // -> make()
        // -> each(function($apartment){
        //     $service= Service :: inRandomOrder()->first() ;

        //     $apartment -> service()-> attach($service);
        //     $apartment ->save();  
        // }) ;
    }
}
