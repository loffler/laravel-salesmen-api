<?php

namespace Database\Seeders;

use App\Models\Salesman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salesmenCsv = fopen(base_path('database/seeds/salesmen.csv'), 'r');
        $firstRow = true;
        while (($data = fgetcsv($salesmenCsv, null, ';')) !== false) {
            if (!$firstRow) {
                Salesman::create([
                    'first_name' => $data['0'],
                    'last_name' => $data['1'],
                    'titles_before' => array_filter(explode(',', $data['2'])),
                    'titles_after' => array_filter(explode(',', $data['3'])),
                    'prosight_id' => $data['4'],
                    'email' => $data['5'],
                    'phone' => $data['6'],
                    'gender' => $data['7'],
                    'marital_status' => empty(trim($data['8'])) ? null : trim($data['8']),
                ]);
            }
            $firstRow = false;
        }
    }
}
