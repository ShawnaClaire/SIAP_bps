<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SatuanKerja extends Migration
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
            'kode_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => '4',
            ],
            'nama_satker' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('satker');        
    }

    public function down()
    {
        $this->forge->dropTable('satker');
    }
}
