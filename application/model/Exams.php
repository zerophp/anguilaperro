<?php

class Model_Exams
{
	public $adapter;
	protected $model = 'Model_Exams_Exams';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	public function getExams()
	{
		return $this->modelInstance
			 ->readExams();
	}
	
	public function getExam($id)
	{
		return $this->modelInstance
		->readExam($id);
	}
	
	public function updateExam($exam, $id)
	{
		return $this->modelInstance
		->writeExam($exam, $id);
	}
	
	public function insertExam($exam)
	{
		return $this->modelInstance
		->writeExam($exam);
	}
	
	public function deleteExam($id)
	{
		return $this->modelInstance
		->removeExam($id);
	}
}