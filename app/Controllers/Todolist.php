<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use CodeIgniter\RESTful\ResourceController;

class Todolist extends ResourceController
{
	protected $modelName = 'App\Models\TodolistModel';
	protected $format = 'json';

	function __construct()
	{
		$this->validation = \Config\Services::validation();
		$this->helper = new Helpers;
		$this->DB = \Config\Database::connect();
	}

	/** POST */
	function create()
	{
		$data = $this->request->getPost();
		$file = $this->request->getFile('image');

		$this->validation->run($data, 'createTodo');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		if ($file == null)
			return $this->respond(['message' => 'No file upload.', 'required' => '[image]'], 400);
		else {

			$data['image'] = $file_name = $file->getRandomName();
			$file->move('assets/uploads/todoList/', $file_name, true);

			$todolist = new \App\Entities\Todolist();
			$todolist->fill($data);
			$todolist->setCreatedAt();

			return $this->model->save($todolist) ?
				$this->respondCreated(['todo' => $this->model->getTodo($this->model->getInsertID())], 'Todo Created')
				:
				$this->failServerError('Todo created failed.');
		}
	}

	/** GET */
	function show($uid = null)
	{
		$todolist = $this->model->getTodolist($uid);

		if ($todolist != null) {

			foreach ($todolist as $todo) {
				$todo->created_at = $this->helper->timeToHumanize($todo->created_at);
				if ($todo->updated_at != null) $todo->updated_at = $this->helper->timeToHumanize($todo->updated_at);
			}

			return $this->respond(['message' => 'Show Todolist', 'todoList' => $todolist]);
		} else
			return $this->failNotFound('Show Todolist -> Todolist uid [' . $uid . '] not found.');
	}

	/** GET */
	function edit($id = null)
	{
		$todo = $this->model->getTodo($id);

		if ($todo != null) {
			$todo->created_at = $this->helper->timeToHumanize($todo->created_at);
			if ($todo->updated_at != null) $todo->updated_at = $this->helper->timeToHumanize($todo->updated_at);

			return $this->respond(['message' => 'Edit Todo', 'todo' => $todo]);
		} else
			return $this->failNotFound('Edit Todo -> Todo id [' . $id . '] not found.');
	}

	/** PUT */
	function update($id = null)
	{
		$data = $this->request->getRawInput();
		$data['id'] = $id;

		if (!$this->model->findByID($id)) return $this->failNotFound('Todo id [' . $id . '] not found.');

		$this->validation->run($data, 'updateTodo');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$todolist = new \App\Entities\Todolist();
		$todolist->fill($data);
		$todolist->setUpdatedAt();

		return $this->model->save($todolist) ?
			$this->respondUpdated(['todo' => $this->model->getTodo($id)], 'Todo Updated')
			:
			$this->failServerError('Todo updated failed.');
	}

	/** POST */
	function upload($id = null)
	{
		$data['id'] = $id;
		$file = $this->request->getFile('image');

		if (!$this->model->findByID($id)) return $this->failNotFound('Todo id [' . $id . '] not found.');

		if ($file == null)
			return $this->respond(['message' => 'No file upload.', 'required' => '[image]'], 400);
		else {
			$dir = 'assets/uploads/todoList/';

			$old_file = $dir . $this->model->getTodo($id)->image;
			if (file_exists($old_file)) unlink($old_file);

			$data['image'] = $file_name = $file->getRandomName();
			$file->move($dir, $file_name, true);

			$todolist = new \App\Entities\Todolist();
			$todolist->fill($data);
			$todolist->setCreatedAt();

			return $this->model->save($todolist) ?
				$this->respondUpdated(['todo' => $this->model->getTodo($id)], 'Todo Created')
				:
				$this->failServerError('Todo created failed.');
		}
	}

	/** DELETE */
	function delete($id = null)
	{
		if (!$this->model->findByID($id)) return $this->failNotFound('Todo id [' . $id . '] not found.');

		$file = 'assets/uploads/todoList/' . $this->model->getTodo($id)->image;
		if (file_exists($file)) unlink($file);

		return $this->model->delete($id) ?
			$this->respondDeleted(['message' => 'Todo id [' . $id . '] deleted.'])
			:
			$this->failServerError('Todo deleted failed.');
	}

	/** DELETE */
	function deleteAll($uid = null)
	{
		if (!$this->model->findByUID($uid)) return $this->failNotFound('Todolist uid [' . $uid . '] not found.');

		$todolist = $this->model->getTodolist($uid);

		foreach ($todolist as $todo) {
			$id = $todo->id;

			$file = 'assets/uploads/todoList/' . $this->model->getTodo($id)->image;
			if (file_exists($file)) unlink($file);
		}

		return $this->model->deleteTodolist($uid) ?
			$this->respondDeleted(['message' => 'Todolist uid [' . $uid . '] deleted.'])
			:
			$this->failServerError('Todolist deleted failed.');
	}
}
