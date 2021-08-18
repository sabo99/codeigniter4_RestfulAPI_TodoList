<?php

namespace App\Models;

use App\Helpers\Helpers;
use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table                = 'users';
	protected $primaryKey           = 'uid';
	protected $returnType           = 'App\Entities\Users';
	protected $allowedFields        = ['email', 'username', 'password', 'two_factor_auth', 'avatar', 'created_at', 'updated_at'];
	protected $useTimestamps        = false;

	function __construct()
	{
		$this->helpers = new Helpers;
		$this->DB = \Config\Database::connect();
	}

	function getUserByUID(int $uid = null)
	{
		$builder = $this->DB->table('users');

		$builder->select('uid, email, username, avatar, two_factor_auth, created_at, updated_at');
		$builder->where('uid', $uid);
		return $builder->get()->getRowObject();
	}

	function getUserAuth(string $email, string $password)
	{
		$builder = $this->DB->table('users');

		$builder->select('uid, email, username, avatar, two_factor_auth, created_at, updated_at');
		$builder->where('email', $email)->where('password', $this->helpers->getResultEncrypted($password));
		return $builder->get()->getRowObject();
	}

	function getUserByEmail(string $email)
	{
		$builder = $this->DB->table('users');

		$builder->select('uid, email, created_at, updated_at');
		$builder->where('email', $email);
		return $builder->get()->getRowObject();
	}

	function findByUID(int $uid)
	{
		$builder = $this->DB->table('users');

		$builder->select('uid');
		$builder->where('uid', $uid);
		return $builder->get()->getNumRows() == 1 ? true : false;
	}
}
