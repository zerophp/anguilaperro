<?php

class Model_DoExam
{
	public $adapter;
	protected $model = 'Model_DoExam_DoExam';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	public function readExams($userEmail)
	{		
		return $this->modelInstance->readExams($userEmail);
	}	
}