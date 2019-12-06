<?php

use Illuminate\Database\Seeder;

use App\SchoolType;

class SchoolTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'TK',
            'KB',
            'TPA',
            'SPS',
            'SD',
            'SMP',
            'SDLB',
            'SMPLB',
            'MI',
            'MTs',
            'Paket A',
            'Paket B',
            'SMA',
            'SMLB',
            'SMK',
            'MA',
            'MAK',
            'Paket C',
            'Akademik',
            'Politeknik',
            'Sekolah Tinggi',
            'Institut',
            'Universitas',
            'SLB',
            'Kursus',
            'Keaksaraan',
            'TBM',
            'PKBM',
            'Life Skill',
            'Satap TK SD',
            'Satap SD SMP',
            'Satap TK SD SMP',
            'Satap SD SMP SMA',
            'RA',
            'SMP Terbuka',
            'SMPTK',
            'SMTK',
            'SDTK',
            'SPK PG',
            'SPK TK',
            'SPK SD',
            'SPK SMP',
            'SPK SMA',
            'Pondok Pesantren',
            'SMAg.K',
            'SKB',
            'Taman Seminari',
            'TKLB',
            'Pratama W P',
            'Adi W P',
            'Madyama W P',
            'Utama W P',
            'SMAK',
        ];

        foreach($datas as $data){
            $type = new SchoolType();
            $type->name = $data;
            $type->save();
        }
    }
}
