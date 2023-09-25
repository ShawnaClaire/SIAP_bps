<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class KegiatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2022',
                'uraian_detail_akun' => 'Pencacahan Sakernas 2022',
                'jenis_kegiatan_id' => 1,
                'satuan_kegiatan_id' => 1,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '7,8',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2022',
                'uraian_detail_akun' => 'Pengolahan Sakernas 2022',
                'jenis_kegiatan_id' => 3,
                'satuan_kegiatan_id' => 1,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '8,9',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2023',
                'uraian_detail_akun' => 'Pencacahan Sakernas 2023',
                'jenis_kegiatan_id' => 1,
                'satuan_kegiatan_id' => 1,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '7,8',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2023',
                'uraian_detail_akun' => 'Pemeriksaan Sakernas 2023',
                'jenis_kegiatan_id' => 2,
                'satuan_kegiatan_id' => 1,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '7,8,9',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2023',
                'uraian_detail_akun' => 'Pengolahan Sakernas 2023',
                'jenis_kegiatan_id' => 3,
                'satuan_kegiatan_id' => 1,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '7,8,9',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2023',
                'uraian_detail_akun' => 'Pencacahan ST2023',
                'jenis_kegiatan_id' => 4,
                'satuan_kegiatan_id' => 3,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '7,8,9',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'kode_mata_anggaran' => '2905.BMA.004.005.A.521213',
                'tahun_anggaran' => '2023',
                'uraian_detail_akun' => 'Pengolahan ST2023',
                'jenis_kegiatan_id' => 6,
                'satuan_kegiatan_id' => 3,
                'volume' => 10,
                'harga_satuan' => 500000,
                'subjectmatter_id' => 1,
                'jadwal_mulai' => Time::now(),
                'jadwal_akhir' => Time::now(),
                'bulan_bayar' => '8,9,10',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            
            
        ];

        
        // Using Query Builder
        $this->db->table('kegiatan')->insertBatch($data);
    }
}
