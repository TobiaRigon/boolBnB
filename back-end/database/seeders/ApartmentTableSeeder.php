<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\User;

class ApartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment :: factory()
        -> count(10)
        -> make()
        -> each(function($apartment){
            $user= User :: inRandomOrder()->first() ;

            $apartment -> user()-> associate($user);
            $apartment ->save();  
        }) ;
    }
}
