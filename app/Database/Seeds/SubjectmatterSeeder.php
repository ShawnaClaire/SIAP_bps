<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SubjectmatterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_subjectmatter' => 'Sosial',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_subjectmatter' => 'Produksi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_subjectmatter' => 'Distribusi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_subjectmatter' => 'Neraca',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama_subjectmatter' => 'IPDS',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        
        // Using Query Builder
        $this->db->table('subjectmatter')->insertBatch($data);
    }
}
