<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IdentitasPengemudi extends Migration
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
            'nomor_identitas_pengemudi' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'nama_pengemudi' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'alamat_pengemudi' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'nomor_handphone_pengemudi' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'ttd_digital' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'foto_pelanggar' => [
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
        $this->forge->createTable('identitas_pengemudi', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('identitas_pengemudi');
    }
}
