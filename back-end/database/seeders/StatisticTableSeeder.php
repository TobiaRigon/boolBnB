<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Statistic;
use App\Models\Apartment;
use Faker\Generator as Faker;

class StatisticTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {

            $totalStatistics = rand(100, 500);

            for ($month = 1; $month <= 12; $month++) {

                $statisticsForMonth = rand(0, 50);

                $statisticsForMonth = min($statisticsForMonth, $totalStatistics);

                $totalStatistics -= $statisticsForMonth;

                for ($i = 0; $i < $statisticsForMonth; $i++) {

                    $statistic = [
                        "apartment_id" => $apartment->id,
                        "ip_address" => $faker->ipv4(),
                        "date" => $faker->dateTimeBetween("-$month months", "-$month months")->format('Y-m-d H:i:s'),
                        "created_at" => $faker->dateTimeBetween("-$month months", "-$month months")
                    ];

                    Statistic::create($statistic);
                }
            }
        }
    }
}
