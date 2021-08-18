<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'uid' 				=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'email' 			=> ['type' => 'varchar', 'constraint' => 100],
			'username' 			=> ['type' => 'varchar', 'constraint' => 100],
			'password' 			=> ['type' => 'text'],
			'two_factor_auth' 	=> ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
			'avatar' 			=> ['type' => 'text', 'null' => true],
			'created_at' 		=> ['type' => 'datetime'],
			'updated_at' 		=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('uid', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
