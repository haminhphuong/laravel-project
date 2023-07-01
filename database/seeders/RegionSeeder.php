<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = database_path('seeders/data/regions.csv');
        $csv = array_map('str_getcsv', file($csvFile));

        foreach ($csv as $row) {
            DB::table('regions')->insert([
                'ma' => $row[0],
                'ten' => $row[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
