<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisKegiatan extends Migration
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
            'jenis_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sbml' => [
                'type'       => 'INT',
                'constraint' => 125,
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
        $this->forge->createTable('jeniskegiatan');        
    }

    public function down()
    {
        $this->forge->dropTable('jeniskegiatan');
    }
}
