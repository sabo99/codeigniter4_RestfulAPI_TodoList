<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class LogUsers extends ResourceController
{
	protected $modelName = 'App\Models\LogUsersModel';
	protected $format = 'json';

	function __construct()
	{
		$this->validation = \Config\Services::validation();
	}

	function create()
	{
		$data = $this->request->getPost();

		$this->validation->run($data, 'log');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$log = new \App\Entities\LogUsers();
		$log->fill($data);
		$log->ip_address = $this->request->getIPAddress();
		$log->setCreatedAt();

		return $this->model->save($log) ?
			$this->respondCreated(['logUsers' => $this->model->getLogUser($data['uid'])], 'LogUser Created')
			:
			$this->failServerError('LogUser created failed.');
	}

	function show($uid = null)
	{
		$log = $this->model->getLogUser($uid);
		return $log ?
			$this->respond(['message' => 'Show LogUser', 'logUsers' => $log])
			:
			$this->failNotFound('Show LogUser -> LogUser uid [' . $uid . '] not found.');
	}
}
