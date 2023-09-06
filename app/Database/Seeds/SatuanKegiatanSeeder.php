<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class SatuanKegiatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'satuan_kegiatan' => 'Dokumen',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'satuan_kegiatan' => 'Blok Sensus',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'satuan_kegiatan' => 'O-B',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'satuan_kegiatan' => 'O-K',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'satuan_kegiatan' => 'O-P',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        
        // Using Query Builder
        $this->db->table('satuankegiatan')->insertBatch($data);
    }
}
