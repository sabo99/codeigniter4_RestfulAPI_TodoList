<?php

namespace App\Database\Seeds;

use App\Helpers\Helpers;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$helpers = new Helpers;
		$data = [
			'email' 	 => 'seeder@gmail.com',
			'username' 	 => 'Seeder',
			'password' 	 => $helpers->getResultEncrypted('seeder'),
			'created_at' => Time::now(),
		];

		$this->db->table('users')->insert($data);
	}
}
