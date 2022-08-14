<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KlasifikasiKendaraan extends Migration
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
            'jenis_kendaraan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'klasifikasi_kendaraan' => [
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
        $this->forge->addForeignKey('jenis_kendaraan_id', 'jenis_kendaraan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('klasifikasi_kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('klasifikasi_kendaraan');
    }
}
