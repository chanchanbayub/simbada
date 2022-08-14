<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeKendaraan extends Migration
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
            'klasifikasi_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'type_kendaraan' => [
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
        $this->forge->addForeignKey('klasifikasi_id', 'klasifikasi_kendaraan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('type_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('type_kendaraan');
    }
}
