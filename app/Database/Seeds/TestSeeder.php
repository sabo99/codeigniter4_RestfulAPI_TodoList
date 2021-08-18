<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
	public function run()
	{
		$this->call('LogUsersSeeder');
		$this->call('TodolistSeeder');
		$this->call('UsersSeeder');
	}
}
