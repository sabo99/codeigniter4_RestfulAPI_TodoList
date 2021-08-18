<?php

namespace App\Entities;

use App\Helpers\Helpers;
use CodeIgniter\Entity\Entity;


class Users extends Entity
{
	function __construct()
	{
		$this->helpers = new Helpers;
	}

	function setPassword(string $password)
	{
		$this->attributes['password'] = $this->helpers->getResultEncrypted($password);
		return $this;
	}

	function setCreatedAt()
	{
		$this->attributes['created_at'] = $this->helpers->currentDateTime(date("Y-m-d H:i:s"));
		return $this;
	}

	function setUpdatedAt()
	{
		$this->attributes['updated_at'] = $this->helpers->currentDateTime(date("Y-m-d H:i:s"));
		return $this;
	}
}
