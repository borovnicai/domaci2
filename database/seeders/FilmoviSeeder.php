<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FilmModel;


class FilmoviSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {

            FilmModel::create([
                'nazivFilma' => $faker->sentence(3),
                'trajanje' => rand(100,260),
                'reziser' => $faker->name
            ]);
        }
    }
}
