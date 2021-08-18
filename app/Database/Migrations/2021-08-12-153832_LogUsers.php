<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogUsers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'log_id' 		=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'uid' 			=> ['type' => 'INT', 'constraint' => 11],
			'ip_address' 	=> ['type' => 'VARCHAR', 'constraint' => 20],
			'mac_address' 	=> ['type' => 'VARCHAR', 'constraint' => 20],
			'action' 		=> ['type' => 'VARCHAR', 'constraint' => 100],
			'created_at' 	=> ['type' => 'DATETIME'],
		]);

		$this->forge->addKey('log_id', true);
		$this->forge->createTable('logusers');
	}

	public function down()
	{
		$this->forge->dropTable('logusers');
	}
}
