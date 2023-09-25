<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_id' => 1,
                'email' => 'fadhilla@bps.go.id',
                'password' => '12345',
                'kode_satker'=> '3671',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'role_id' => 2,
                'email' => 'sosial@bps.go.id',
                'password' => '12345',
                'kode_satker'=> '3671',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

       
        // Using Query Builder
        $this->db->table('user')->insertBatch($data);
    }
}
