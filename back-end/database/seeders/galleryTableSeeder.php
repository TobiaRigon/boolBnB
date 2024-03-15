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
        $galleries = [
            [
                "apartment_id"=> "1",
                "path_image"=> "back-end\public\images\appartment1.jpeg",
            ],
            [
                "apartment_id"=> "1",
                "path_image"=> "apartments/01_02.jpg",
            ],
            [
                "apartment_id"=> "2",
                "path_image"=> "apartments/02_01.jpg",
            ],
            [
                "apartment_id"=> "2",
                "path_image"=> "apartments/02_02.jpg",
            ],
            [
                "apartment_id"=> "1",
                "path_image"=> "apartments/04_01.jpg",
            ],
            [
                "apartment_id"=> "1",
                "path_image"=> "apartments/06_01.jpg",
            ],
            [
                "apartment_id"=> "1",
                "path_image"=> "apartments/08_01.jpg",
            ],
            [
                "apartment_id"=> "1",
                "path_image"=> "apartments/08_02.jpg",
            ],
            [
                "apartment_id"=> "2",
                "path_image"=> "apartments/09_01.jpg",
            ],
            [
                "apartment_id"=> "2",
                "path_image"=> "apartments/10_01.jpg",
            ],
        ];

            // Ciclo per inserire le immagini della galleria nel database
            foreach ($galleries as $galleryData) {
                Gallery::create($galleryData);
            }
    }
}
