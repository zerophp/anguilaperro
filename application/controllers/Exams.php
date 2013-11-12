<?php

class Controllers_Exams
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function indexAction($viewparams)
	{
		$exam = new Model_Exam();
		$viewparams['exam']=$exam->getExam();
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function insertAction($viewparams)
	{
	if($_POST){
			$exam = array();
			$exam['topic'] = $_POST['topic'];
			$exam['difficulty'] = $_POST['difficulty'];
			if(empty($_POST['id'])){
				$viewparams['exam']=$exam->insertExam($exam);
			}else{
				echo($_POST['id']);
				echo (var_dump($exam)) ;
				die();
				$viewparams['exam']=$exam->updateExam($exam,$_POST['id']);
			}
			header("Location: /exam");
		}
		if(isset($request['params']['id'])){
			$id = $request['params']['id'];
			$viewparams['exam']=$exam->getExam($id);
		}else{
			$viewparams = array();
		}
		
		
		$exam = new Model_Exam();
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('backend', $layoutparams);
	}


}
