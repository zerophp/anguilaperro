<?php
class Model_Exam
{
	public $adapter;
	protected $model = 'Model_Exam_Exam';
	protected $modelInstance;

	public function __construct()
	{
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}

	public function getExam()
	{
		return $this->modelInstance
		->readExams();
	}
}