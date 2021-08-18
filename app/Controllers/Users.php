<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
	protected $modelName = 'App\Models\UsersModel';
	protected $format = 'json';


	function __construct()
	{
		$this->validation = \Config\Services::validation();
	}

	/** POST */
	function signUp()
	{
		$data = $this->request->getPost();

		$this->validation->run($data, 'signUp');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$user = new \App\Entities\Users();
		$user->fill($data);
		$user->setCreatedAt();

		return $this->model->save($user) ?
			$this->respondCreated(['user' => $this->model->getUserByUID($this->model->getInsertID())], 'User Created')
			:
			$this->failServerError('User created failed');
	}

	/** POST */
	function signIn()
	{
		$data = $this->request->getPost();

		$this->validation->run($data, 'signIn');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$user = $this->model->getUserAuth($data['email'], $data['password']);

		return $user != null ?
			$this->respond(['message' => 'Login successfully.', 'user' => $user])
			:
			$this->failNotFound('User not found.');
	}

	/** GET 
	 * Forgot Password
	 */
	function forgot($email = null)
	{
		$data['email'] = $email;

		$this->validation->run($data, 'forgotPassword');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$user = $this->model->getUserByEmail($email);

		return $user != null ?
			$this->respond(['message' => 'Forgot Password', 'user' => $user])
			:
			$this->failNotFound('ForgotPassword -> User email [' . $email . '] not found.');
	}

	/** GET */
	function show($uid = null)
	{
		$user = $this->model->getUserByUID($uid);

		return $user != null ?
			$this->respond(['message' => 'Show User', 'user' => $user])
			:
			$this->failNotFound('Show User -> User ID [' . $uid . '] not found.');
	}

	/** GET */
	function edit($uid = null)
	{
		$user = $this->model->getUserByUID($uid);

		return $user != null ?
			$this->respond(['message' => 'Edit User', 'user' => $user])
			:
			$this->failNotFound('Edit User -> User ID [' . $uid . '] not found.');
	}

	/** GET 
	 * CheckEmailExists
	 */
	function exists($email)
	{
		$data['email'] = $email;

		$this->validation->run($data, 'emailExists');
		$errors = $this->validation->getErrors();

		return $errors ?
			$this->respond(['errorValidation' => $errors], 400)
			:
			$this->respond(['message' => 'Email can be used.']);
	}

	/** PUT */
	function update($uid = null)
	{
		$data = $this->request->getRawInput();
		$data['uid'] = $uid;

		if (!$this->model->findByUID($uid)) return $this->failNotFound('User uid [' . $uid . '] not found.');

		$this->validation->run($data, 'updateUser');
		$errors = $this->validation->getErrors();
		if ($errors) return $this->respond(['errorValidation' => $errors], 400);

		$user = new \App\Entities\Users();
		$user->fill($data);
		$user->setUpdatedAt();

		return $this->model->save($user) ?
			$this->respondUpdated(['user' => $this->model->getUserByUID($uid)], 'User Updated')
			:
			$this->failServerError('User updated failed.');
	}

	/** POST */
	function upload($uid = null)
	{
		$file = $this->request->getFile('avatar');
		$data['uid'] = $uid;

		if (!$this->model->findByUID($uid)) return $this->failNotFound('User uid [' . $uid . '] not found.');

		if ($file == null)
			return $this->respond(['message' => 'No file upload.', 'required' => '[avatar]'], 400);
		else {
			$dir = 'assets/uploads/users/';

			$old_file =  $dir . $this->model->getUserByUID($uid)->avatar;
			if (file_exists($old_file)) unlink($old_file);

			$data['avatar'] = $file_name = $file->getRandomName();
			$file->move($dir, $file_name, true);


			$user = new \App\Entities\Users();
			$user->fill($data);
			$user->setUpdatedAt();

			return $this->model->save($user) ?
				$this->respondUpdated(['user' => $this->model->getUserByUID($uid)], 'User Updated')
				:
				$this->failServerError('User created failed.');
		}
	}

	/** DELETE */
	function delete($uid = null)
	{
		if (!$this->model->findByUID($uid)) return $this->failNotFound('User uid [' . $uid . '] not found.');

		$file = 'assets/uploads/users/' . $this->model->getUserByUID($uid)->avatar;
		if (file_exists($file)) unlink($file);

		return $this->model->delete($uid) ?
			$this->respondDeleted(['message' => 'User uid [' . $uid . '] deleted.'])
			:
			$this->failServerError('User deleted failed.');
	}
}
