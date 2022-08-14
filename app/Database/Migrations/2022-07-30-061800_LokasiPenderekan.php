<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LokasiPenderekan extends Migration
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
            'provinsi_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kota_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kecamatan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kelurahan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'nama_jalan' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'nama_gedung' => [
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
        $this->forge->addForeignKey('provinsi_id', 'provinsi', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kota_id', 'kota', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kelurahan_id', 'kelurahan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('lokasi_penderekan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('lokasi_penderekan');
    }
}
