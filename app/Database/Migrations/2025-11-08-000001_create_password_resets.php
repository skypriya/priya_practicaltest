<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordResets extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>         ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' =>    ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'email' =>      ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'selector' =>   ['type' => 'CHAR', 'constraint' => 24, 'null' => false],
            'token_hash' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'expires_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('selector');
        $this->forge->createTable('password_resets');
    }

    public function down()
    {
        $this->forge->dropTable('password_resets');
    }
}
