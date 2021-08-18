<?php

namespace App\Database\Seeds;

use App\Helpers\Helpers;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LogUsersSeeder extends Seeder
{
	public function run()
	{
		$helpers = new Helpers;
		$data = [
			'uid' 	 	 	=> 1,
			'ip_address' 	=> '192.168.1.1',
			'mac_address'	=> '0A:1B:2C:3D:4E:5F',
			'action'		=> 'Seeder',
			'created_at' 	=> Time::now(),
		];

		$this->db->table('logusers')->insert($data);
	}
}
