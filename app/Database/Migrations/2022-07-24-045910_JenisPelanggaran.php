<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisPelanggaran extends Migration
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
            'pasal_pelanggaran' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
            ],
            'keterangan' => [
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
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('jenis_pelanggaran', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('jenis_pelanggaran');
    }
}
