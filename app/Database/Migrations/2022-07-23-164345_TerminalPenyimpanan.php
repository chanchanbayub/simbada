<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TerminalPenyimpanan extends Migration
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
                'null' => false,
                'unsigned' => true
            ],
            'tempat_penyimpanan' => [
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
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('tempat_penyimpanan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('tempat_penyimpanan');
    }
}
