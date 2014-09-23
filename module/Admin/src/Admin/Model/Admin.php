<?php
namespace Admin\Model;

class Admin
{
	public $id;
	public $username;
	public $password;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->username = (isset($data['username'])) ? $data['username'] : null;
		$this->password  = (isset($data['password'])) ? $data['password'] : null;
	}
}