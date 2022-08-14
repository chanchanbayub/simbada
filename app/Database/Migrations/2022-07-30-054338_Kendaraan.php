<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kendaraan extends Migration
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
            'jenis_kendaraan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'klasifikasi_kendaraan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'type_kendaraan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'merk_kendaraan' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'nomor_kendaraan' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'warna_kendaraan' => [
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
        $this->forge->addForeignKey('jenis_kendaraan_id', 'jenis_kendaraan', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('klasifikasi_kendaraan_id', 'klasifikasi_kendaraan', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('type_kendaraan_id', 'type_kendaraan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('kendaraan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('kendaraan');
    }
}
