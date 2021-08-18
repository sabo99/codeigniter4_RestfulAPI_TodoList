<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todolist extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'uid' 			=> ['type' => 'INT', 'constraint' => 11],
			'title' 		=> ['type' => 'VARCHAR', 'constraint' => 200],
			'desc' 			=> ['type' => 'TEXT'],
			'image' 		=> ['type' => 'TEXT', 'null' => true],
			'created_at' 	=> ['type' => 'DATETIME'],
			'updated_at' 	=> ['type' => 'DATETIME', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('todolist');
	}

	public function down()
	{
		$this->forge->dropTable('todolist');
	}
}
