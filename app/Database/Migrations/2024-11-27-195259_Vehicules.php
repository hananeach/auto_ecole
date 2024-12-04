<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vehicules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'Image' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'Nom' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'Modele' => [
                'type'       => 'INT',
                'constraint' => '20',
                'null'       => true,
            ],
            'DateAchat' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'Matricule' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('vehicules');
    }

    public function down()
    {
        $this->forge->dropTable('vehicules');
    }
}
