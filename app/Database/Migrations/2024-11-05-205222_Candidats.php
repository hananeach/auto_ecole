<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Candidats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'cin'        => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'tele'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => false,
            ],
            'image'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Peut être NULL si l'image est optionnelle
            ],
            'dateInscription' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'moniteur_pratique_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'moniteur_theorique_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'prix' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'age' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'adresse' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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

        // Clé primaire
        $this->forge->addKey('id', true);

        // Clés étrangères
        $this->forge->addForeignKey('moniteur_pratique_id', 'moniteurs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('moniteur_theorique_id', 'moniteurs', 'id', 'CASCADE', 'CASCADE');

        // Création de la table
        $this->forge->createTable('candidats');
    }

    public function down()
    {
        $this->forge->dropTable('candidats');
    }
}

