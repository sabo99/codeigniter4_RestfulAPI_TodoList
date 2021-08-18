<?php

namespace App\Models;

use App\Helpers\Helpers;
use CodeIgniter\Model;

class LogUsersModel extends Model
{
	protected $table                = 'logusers';
	protected $primaryKey           = 'log_id';
	protected $returnType           = 'App\Entities\LogUsers';
	protected $allowedFields        = ['uid', 'ip_address', 'mac_address', 'action', 'created_at'];
	protected $useTimestamps        = false;

	function __construct()
	{
		$this->helpers = new Helpers;
		$this->DB = \Config\Database::connect();
	}

	function getLogUser(int $uid)
	{
		$builder = $this->DB->table('logusers');

		$builder->where('uid', $uid);
		return $builder->get()->getLastRow();
	}
}
