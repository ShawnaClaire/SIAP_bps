<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 50,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_mata_anggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'tahun_anggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '11',
            ],
            'uraian_detail_akun' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'satuan_kegiatan_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'honor' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'bulan_bayar' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'subjectmatter_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => true
            ],
            'jadwal_mulai' => [
                'type' => 'DATE'
            ],
            'jadwal_akhir' => [
                'type' => 'DATE'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'NULL' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'NULL' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kegiatan');
        $this->forge->addForeignKey('subjectmatter_id', 'subjectmatter', 'id', 'CASCADE', 'SET NULL', 'subjectmatter_fk'); //on update CASCADE, on delete SET NULL
        $this->forge->addForeignKey('satuan_kegiatan_id', 'satuankegiatan', 'id', 'CASCADE', 'SET NULL', 'satuan_kegiatan_fk'); //on update CASCADE, on delete SET NULL

    }

    public function down()
    {
        $this->forge->dropTable('kegiatan');
    }
}
