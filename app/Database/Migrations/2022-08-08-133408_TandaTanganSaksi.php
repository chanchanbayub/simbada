<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TandaTanganSaksi extends Migration
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
            'saksi_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tanda_tangan_saksi' => [
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
        $this->forge->addForeignKey('saksi_id', 'saksi_penderekan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('tanda_tangan_saksi', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('tanda_tangan_saksi');
    }
}
