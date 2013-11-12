<?php

class Model_Users
{
	public $adapter;
	protected $model = 'Users';
	protected $modelInstance;
	
	public function __construct()
	{
		$this->adapter = $_SESSION['register']['adapter'];
		//$clase="Model_Users_UsersMysql";
		$clase="Model_Users_".$this->model.ucfirst($this->adapter);
		$modelInstance = new $clase; //Aqui tendremos modelInstance = UsersMysql
		//echo "<pre>";
		//print_r($modelInstance);
		//echo "</pre>";
	}
	
	public function getUsers()
	{
		//$this->$modelInstance->getUsers();
		$clase="Model_Users_".$this->model.ucfirst($this->adapter);
		$u = new $clase; //Aqui tendremos modelInstance = UsersMysql
		$users=$u->readUsers();
		return $users;
	}
}