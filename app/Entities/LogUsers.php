<?php

namespace App\Entities;

use App\Helpers\Helpers;
use CodeIgniter\Entity\Entity;

class LogUsers extends Entity
{
	function __construct()
	{
		$this->helpers = new Helpers;
	}

	function setCreatedAt()
	{
		$this->attributes['created_at'] = $this->helpers->currentDateTime(date("Y-m-d H:i:s"));
		return $this;
	}
}
