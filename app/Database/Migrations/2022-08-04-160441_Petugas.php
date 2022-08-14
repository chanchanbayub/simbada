<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
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
                'unsigned' => true,
            ],
            'unit_id' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'nip_npjlp' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'jabatan_id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
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
        $this->forge->addForeignKey('unit_id', 'unit_penindak', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('jabatan_id', 'jabatan', 'id', 'cascade', 'cascade');
        $attributes = ['ENGINE' => 'innoDB'];
        $this->forge->createTable('petugas', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('petugas');
    }
}
