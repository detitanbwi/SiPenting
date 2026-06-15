<?php

namespace Database\Seeders;

use App\Models\bayi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class histStun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        // Ambil hanya 5 bayi secara acak agar total data di bawah 100
        $bayiIds = bayi::inRandomOrder()->take(5)->pluck('id')->toArray();
        $insertData = [];

        // 2 bulan terakhir
        $bulanArray = [];
        for ($m = 1; $m >= 0; $m--) {
            $bulanArray[$m] = now()->subMonths($m)->startOfMonth();
        }

        foreach ($bayiIds as $idBayi) {
            // Set kondisi awal bayi secara acak tapi realistis
            $status = rand(1, 4); 
            // 1: sangat pendek, 2: pendek, 3: normal, 4: tinggi

            foreach ($bulanArray as $startOfMonth) {
                // Buat tanggal 1–5 setiap bulan
                $tanggalArray = [];
                for ($i = 0; $i < 5; $i++) {
                    $tanggalArray[] = $startOfMonth->copy()->addDays($i)->toDateString();
                }

                // Simulasikan kemungkinan perubahan status
                $rand = rand(1, 100);
                if ($rand <= 15 && $status > 1) {
                    // 15% kemungkinan naik (membaik)
                    $status--;
                } elseif ($rand >= 90 && $status < 4) {
                    // 10% kemungkinan turun (memburuk)
                    $status++;
                }
                // sisanya stabil

                // Masukkan data untuk minggu pertama bulan ini (5 bayi * 2 bulan * 5 hari = 50 data)
                foreach ($tanggalArray as $tanggal) {
                    $insertData[] = [
                        'tanggal' => $tanggal,
                        'jenis' => $status,
                        'id_bayi' => $idBayi,
                    ];
                }
            }
        }

        // Batch insert biar efisien
        foreach (array_chunk($insertData, 1000) as $chunk) {
            DB::table('hist_stun')->insert($chunk);
        }
    }
}
