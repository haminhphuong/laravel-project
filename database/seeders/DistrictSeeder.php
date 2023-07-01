<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = database_path('seeders/data/districts.csv');
        $csv = array_map('str_getcsv', file($csvFile));

        foreach ($csv as $row) {
            DB::table('districts')->insert([
                'ma' => $row[0],
                'ten' => $row[1],
                'ma_tp' => $row[2],
                'thanh_pho' => $row[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
