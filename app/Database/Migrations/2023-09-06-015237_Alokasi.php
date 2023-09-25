<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alokasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tahun' => [
                'type'       => 'VARCHAR',
                'constraint' => '4',
            ],
            'kegiatan_id' => [
                'type'           => 'INT',
                'constraint'     => 50
            ],
            'sobat_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'beban_kerja' => [
                'type'       => 'INT',
                'constraint' => 25,
            ],
            'posisi_id' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'bulan_bayar_mitra' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
            ],
            'honor' => [
                'type'           => 'INT',
                'constraint'     => 255
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
        $this->forge->createTable('alokasi');  
        $this->forge->addForeignKey('kegiatan_id', 'kegiatan', 'id', 'CASCADE', 'CASCADE', 'kegiatan_fk'); //on update CASCADE, on delete SET NULL
        $this->forge->addForeignKey('sobat_id', 'mitra', 'id', 'CASCADE', 'CASCADE' , 'mitra_fk'); //on update CASCADE, on delete SET NULL
        $this->forge->addForeignKey('posisi_id', 'posisi', 'id', 'CASCADE', 'CASCADE', 'posisi_fk'); //on update CASCADE, on delete SET NULL
      
    }

    public function down()
    {
        $this->forge->dropTable('alokasi');
    }
}
