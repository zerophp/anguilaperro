<?php

class Model_Groups
{
	public $adapter;
	protected $model = 'Model_Groups_Groups';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	public function getGroups()
	{
		return $this->modelInstance
			 ->readGroups();
	}
	
	
	public function getGroup($id)
	{
		return $this->modelInstance
		->readGroup($id);
	}
	
	public function insertGroup($group)
	{
		return $this->modelInstance
		->writeGroup($group);
	}
	
	public function updateGroup($group, $id)
	{
		return $this->modelInstance
		->writeGroup($group, $id);
	}
	
	public function deleteGroup($id)
	{
		return $this->modelInstance
		->removeGroup($id);
	}
	
	
}