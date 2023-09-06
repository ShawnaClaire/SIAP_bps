<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subjectmatter extends Migration
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
            'nama_subjectmatter' => [
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
        $this->forge->createTable('subjectmatter');        
    }

    public function down()
    {
        $this->forge->dropTable('subjectmatter');
    }
}
