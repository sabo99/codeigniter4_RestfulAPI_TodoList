<?php

namespace App\Models;

use App\Helpers\Helpers;
use CodeIgniter\Model;

class TodolistModel extends Model
{
	protected $table                = 'todolist';
	protected $primaryKey           = 'id';
	protected $returnType           = 'App\Entities\Todolist';
	protected $allowedFields        = ['uid', 'title', 'desc', 'image', 'created_at', 'updated_at'];
	protected $useTimestamps        = false;

	function __construct()
	{
		$this->helpers = new Helpers;
		$this->DB = \Config\Database::connect();
	}

	function getTodolist(int $uid)
	{
		$builder = $this->DB->table('todolist');

		$builder->where('uid', $uid);
		return $builder->get()->getResult();
	}

	function getTodo(int $id)
	{
		$builder = $this->DB->table('todolist');

		$builder->where('id', $id);
		return $builder->get()->getRowObject();
	}

	function findByID(int $id)
	{
		$builder = $this->DB->table('todolist');

		$builder->where('id', $id);
		return $builder->get()->getNumRows() == 1 ? true : false;
	}

	function findByUID(int $uid)
	{
		$builder = $this->DB->table('todolist');

		$builder->where('uid', $uid);
		return $builder->get()->getNumRows() >= 1 ? true : false;
	}

	function deleteTodolist(int $uid)
	{
		$builder = $this->DB->table('todolist');

		$builder->where('uid', $uid);
		return $builder->delete();
	}
}
