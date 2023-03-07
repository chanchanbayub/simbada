<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NomorSuratTugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nomor_surat' => [
                'type' => 'varchar',
                'constraint' => 225
            ],
            'created_at' => [
                'type' => 'datetime'
            ],
            'updated_at' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('id');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('nomor_surat_tugas', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('nomor_surat_tugas');
    }
}
