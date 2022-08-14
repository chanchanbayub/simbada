<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penderekan extends Migration
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
                'unsigned' => true,
            ],
            'bap_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'tanggal_penderekan' => [
                'type' => 'date',
                'null' => false,
            ],
            'jam_penderekan' => [
                'type' => 'time',
                'null' => false,
            ],
            'jenis_pelanggaran_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'tempat_penyimpanan_kendaraan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'saksi_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
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
        $this->forge->addForeignKey('bap_id', 'bap', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('jenis_pelanggaran_id', 'jenis_pelanggaran', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('tempat_penyimpanan_kendaraan_id', 'tempat_penyimpanan', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('saksi_id', 'saksi_penderekan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('penderekan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('penderekan');
    }
}
