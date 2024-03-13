<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Message;
use App\Models\Apartment;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message :: factory()
        -> count(10)
        -> make()
        -> each(function($message){
            $apartment= Apartment :: inRandomOrder()->first() ;

            $message -> apartment()-> associate($apartment);
            $message ->save();  
        }) ;
    }
}
