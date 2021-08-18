<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $signUp = [
		'username' 			=> ['rules' => 'required'],
		'email' 			=> ['rules' => 'required|valid_email|is_unique[users.email]'],
		'password' 			=> ['rules' => 'required|min_length[6]'],
		'password_confirm' 	=> ['rules' => 'required|matches[password]'],
	];

	public $signIn = [
		'email' 			=> ['rules' => 'required|valid_email'],
		'password' 			=> ['rules' => 'required|min_length[6]'],
	];

	public $forgotPassword = [
		'email' 			=> ['rules' => 'required|valid_email'],
	];

	public $emailExists = [
		'email' 			=> [
			'rules' 		=> 'required|valid_email|is_unique[users.email]',
			'errors' 		=> [
				'is_unique' => 'Email is already exists.'
			]
		]
	];

	public $updateUser = [
		'uid' 				=> ['rules' => 'required'],
		'email' 			=> ['rules' => 'required|valid_email'],
		'password' 			=> ['rules' => 'required|min_length[6]'],
		'username' 			=> ['rules' => 'required'],
	];

	public $createTodo = [
		'uid' 				=> ['rules' => 'required'],
		'title' 			=> ['rules' => 'required'],
		'desc' 				=> ['rules' => 'required'],
	];

	public $updateTodo = [
		'id' 				=> ['rules' => 'required'],
		'title' 			=> ['rules' => 'required'],
		'desc' 				=> ['rules' => 'required'],
	];

	public $log = [
		'uid' 				=> ['rules' => 'required'],
		'mac_address' 		=> ['rules' => 'required'],
		'action' 			=> ['rules' => 'required'],
	];
}
