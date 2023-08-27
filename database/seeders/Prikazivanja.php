<?php

namespace Database\Seeders;

use App\Models\Prikazivanje;
use Illuminate\Database\Seeder;

class Prikazivanja extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) {

            Prikazivanje::create([
                'dan' => $faker->dateTimeBetween('-5 days', '+30 days'),
                'salaID' => rand(1,4),
                'filmID' => rand(1, 100)
            ]);
        }
    }
}
