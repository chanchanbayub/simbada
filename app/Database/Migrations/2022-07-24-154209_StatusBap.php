<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusBap extends Migration
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
            'status_bap' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('id', true);
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('status_bap', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('status_bap');
    }
}
