<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Gallery;
use App\Models\Apartment;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery :: factory()
        -> count(10)
        -> make()
        -> each(function($gallery){
            $apartment= Apartment :: inRandomOrder()->first() ;

            $gallery -> apartment()-> associate($apartment);
            $gallery ->save();  
        }) ;
    }
}
