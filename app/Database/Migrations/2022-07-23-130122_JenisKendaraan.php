<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisKendaraan extends Migration
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
            'jenis_kendaraan' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
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
        $this->forge->createTable('jenis_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_kendaraan');
    }
}
