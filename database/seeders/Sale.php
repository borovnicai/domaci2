<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Sale extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale = [
            'Sala 1',
            'Sala 2',
            'Sala 3',
            'Sala 4'
        ];

        foreach ($sale as $sala){
            Sala::create([
                'nazivSale' => $sala
            ]);
        }
    }
}
