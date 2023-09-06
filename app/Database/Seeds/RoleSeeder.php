<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role' => 'Admin',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'Sosial',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'Produksi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'Distribusi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'Neraca',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'IPDS',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role' => 'General',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
            
        ];

        
        // Using Query Builder
        $this->db->table('role')->insertBatch($data);
    }
}
