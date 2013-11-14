<?php

class Model_Questions
{
	public $adapter;
	protected $model = 'Model_Questions_Questions';
	protected $modelInstance;
	
	public function __construct()
	{	
		$this->adapter = $_SESSION['register']['adapter'];
		$name=$this->model.$this->adapter;
		$this->modelInstance = new $name();
	}
	
	public function insertQuestion($examId)
	{
		$answer = array(
					"1" => isset($_POST["answ1"])?$_POST["answ1"]:"",
					"2" => isset($_POST["answ2"])?$_POST["answ2"]:"",
					"3" => isset($_POST["answ3"])?$_POST["answ3"]:"",
					"4" => isset($_POST["answ4"])?$_POST["answ4"]:"",
					"5" => isset($_POST["answ5"])?$_POST["answ5"]:""
				   );
		$question = array("examId"=>$examId,
		             "description"=>$_POST["description"],
					 "difficulty"=>$_POST["difficulty"],
					 "type" =>$_POST["type"],
					 "answers" => $answer,
					 "answersCorrect" => explode(",",$_POST["rightansw"]));
		
		return $this->modelInstance->writeQuestion(null,$question);
	}

	public function updateQuestion($examId,$questionId)
	{
				
		foreach ($_POST as $key=>$value){
			$arr=explode('_', $key);
			if($arr[0]=='answ')
				$answer[$arr[1]]=($_POST[$key]);
			}
			

		$question = array("examId"=>$examId,
					 "questionId"=>$questionId,
		             "description"=>$_POST["description"],
					 "difficulty"=>$_POST["difficulty"],
					 "type" =>$_POST["type"],
					 "answers" => $answer,
					 "answersCorrect" => explode(",",$_POST["rightansw"]));
			
		return $this->modelInstance->writeQuestion($questionId,$question);
	}	
	
	public function readQuestions($examId) {
		return $this->modelInstance->readQuestions($examId);
	}
	
	public function readQuestion($question) {
		return $this->modelInstance->readQuestion($question);
	}
		
	public function readAnswers($question) {
		return $this->modelInstance->readAnswers($question);
	}
	
		
	
}