<?php

class Model_Users
{
	public $adapter;
	protected $model = 'Model_Users_Users';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	public function getUsers()
	{
		return $this->modelInstance
			 ->readUsers();
	}
}