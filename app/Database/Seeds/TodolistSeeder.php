<?php

namespace App\Database\Seeds;

use App\Helpers\Helpers;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TodolistSeeder extends Seeder
{
	public function run()
	{
		$helpers = new Helpers;
		$data = [
			'uid' 		=> 1,
			'title' 	=> 'Test',
			'desc' 		=> 'Seeder',
			'image' 	=> 'image.png',
			'created_at' => Time::now(),
		];

		$this->db->table('todolist')->insert($data);
	}
}
