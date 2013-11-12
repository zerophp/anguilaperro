<?php

class Model_Users
{
	public $adapter;
	protected $model = 'Users';
	protected $modelInstance;
	
	public function __construct()
	{
		
		$this->adapter = $_SESSION['register']['adapter'];
		$modelInstance = new $this->model.$this->adapter;
	}
	
	public function getUsers()
	{
		$this->modelInstance
			 ->readUsers();
	}
}