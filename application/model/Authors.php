<?php

class Model_Authors
{
	public $adapter;
	protected $model = 'Model_Authors_Authors';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	
	public function login($email, $password)
	{
		return $this->modelInstance
		->login($email, $password);
	}
	

}