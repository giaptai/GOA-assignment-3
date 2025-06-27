<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Thpt2024ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csv = fopen(public_path('diem_thi_thpt_2024.csv'), 'r');
        $header = fgetcsv($csv);

        DB::disableQueryLog(); //Tắt query log
        $batchSize = 1000;
        $processed = 0;
        $total = 10_000;
        DB::transaction(function () use ($csv, $header, $batchSize, $processed, $total) {
            $insertData = [];

            while (($row = fgetcsv($csv)) && $processed < $total) {
                $data = array_combine($header, $row);
                $processed++;
                $insertData[] = [
                    'sbd' => $data['sbd'],
                    'toan' => is_numeric($data['toan']) ? $data['toan'] : null,
                    'ngu_van' => is_numeric($data['ngu_van']) ? $data['ngu_van'] : null,
                    'ngoai_ngu' => is_numeric($data['ngoai_ngu']) ? $data['ngoai_ngu'] : null,
                    'vat_li' => is_numeric($data['vat_li']) ? $data['vat_li'] : null,
                    'hoa_hoc' => is_numeric($data['hoa_hoc']) ? $data['hoa_hoc'] : null,
                    'sinh_hoc' => is_numeric($data['sinh_hoc']) ? $data['sinh_hoc'] : null,
                    'lich_su' => is_numeric($data['lich_su']) ? $data['lich_su'] : null,
                    'dia_li' => is_numeric($data['dia_li']) ? $data['dia_li'] : null,
                    'gdcd' => is_numeric($data['gdcd']) ? $data['gdcd'] : null,
                    'ma_ngoai_ngu' => $data['ma_ngoai_ngu'] ?: null,
                ];

                if (count($insertData) === $batchSize) {
                    DB::table('exam_scores')->insert($insertData); // insert 1000 bản ghi/lần
                    $insertData = [];
                }
            }
            // 
            if (!empty($insertData)) {
                DB::table('exam_scores')->insert($insertData);
            }
        });
    }
}
