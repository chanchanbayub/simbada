<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bap extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'ukpd_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'noBap' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'ppns_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'unit_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('ppns_id', 'ppns', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('unit_id', 'unit_penindak', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('status_id', 'status_bap', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('bap', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('bap');
    }
}
