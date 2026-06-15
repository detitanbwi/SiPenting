<?php

namespace Database\Seeders;

use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class dataStunt extends Seeder
{
    public function run(): void
    {
        $data = [];
        
        // Generate WHO-like length/height standard growth data for ages 0 to 60 months
        foreach (['Laki-laki', 'Perempuan'] as $gender) {
            // Girls are slightly shorter on average than boys
            $offset = $gender === 'Perempuan' ? -0.5 : 0;
            
            for ($age = 0; $age <= 60; $age++) {
                // growth formula: starts at ~50cm, grows to ~110cm at 60 months
                $median = 49.5 + $offset + 7.6 * sqrt($age);
                
                $data[] = [
                    'Umur (bulan)' => $age,
                    'Panjang Badan (cm) -3 SD' => round($median - 6.0, 1),
                    'Panjang Badan (cm) -2 SD' => round($median - 4.0, 1),
                    'Panjang Badan (cm) -1 SD' => round($median - 2.0, 1),
                    'Panjang Badan (cm) Median' => round($median, 1),
                    'Panjang Badan (cm) +1 SD' => round($median + 2.0, 1),
                    'Panjang Badan (cm) +2 SD' => round($median + 4.0, 1),
                    'Panjang Badan (cm) +3 SD' => round($median + 6.0, 1),
                    'kelamin' => $gender,
                ];
            }
        }

        // Batch insert data_stunt
        DB::table('data_stunt')->insert($data);
    }
}
