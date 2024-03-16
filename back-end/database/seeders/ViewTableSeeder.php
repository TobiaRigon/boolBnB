<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\View;
use App\Models\Apartment;

class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        View :: factory()
        -> count(10)
        -> make()
        -> each(function($view){
            $apartment= Apartment :: inRandomOrder()->first() ;

            $view -> apartment()-> associate($apartment);
            $view ->save();  
        }) ;
    }
}
