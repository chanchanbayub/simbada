<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FotoKendaraan extends Migration
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
            'id_penderekan' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'mime' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'foto' => [
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
        $this->forge->addForeignKey('id_penderekan', 'penderekan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('foto_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('foto_kendaraan');
    }
}
