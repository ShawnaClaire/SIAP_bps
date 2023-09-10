<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class JenisKegiatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'jenis_kegiatan' => 'Pencacahan Survei',
                'sbml' => 3200000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'jenis_kegiatan' => 'Pemeriksaan Survei',
                'sbml' => 3200000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'jenis_kegiatan' => 'Pengolahan Survei',
                'sbml' => 3000000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'jenis_kegiatan' => 'Pencacahan Sensus',
                'sbml' => 4052000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'jenis_kegiatan' => 'Pemeriksaan Sensus',
                'sbml' => 4941000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'jenis_kegiatan' => 'Pengolahan Sensus',
                'sbml' => 3261000,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            
        ];

        
        // Using Query Builder
        $this->db->table('jeniskegiatan')->insertBatch($data);
    }
}
