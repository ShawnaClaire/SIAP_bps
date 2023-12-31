<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => true
            ],
            'kode_satker' => [
                'type' => 'VARCHAR',
                'constraint' => '4',
                'NULL' => true
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
        $this->forge->createTable('user');  
        $this->forge->addForeignKey('role_id', 'role', 'id', 'CASCADE', 'SET NULL', 'role_fk'); //on update CASCADE, on delete SET NULL
        $this->forge->addForeignKey('kode_satker', 'satker', 'kode_satker', 'CASCADE', 'SET NULL', 'satker_fk'); //on update CASCADE, on delete SET NULL
      
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
