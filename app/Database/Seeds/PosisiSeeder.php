<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PosisiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'posisi' => 'PPL',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'posisi' => 'PML',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'posisi' => 'Koseka',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'posisi' => 'Pengolah',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'posisi' => 'Pemeta',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
            
        ];

        
        // Using Query Builder
        $this->db->table('posisi')->insertBatch($data);
    }
}
