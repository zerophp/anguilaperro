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
		$exams = new Model_Exams();		
		$viewparams['exams']=$exams->getExams();
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('backend', $layoutparams);
	}
	
	public function insertAction(){
		$request = $this->request;
		$exams = new Model_Exams();		
		if($_POST){
			$exam = array();
			$exam['topic'] = $_POST['topic'];
			$exam['difficulty'] = $_POST['difficulty'];
			
			if(empty($_POST['id'])){
				$viewparams['exams']=$exams->insertExam($exam);
			}else{
				$viewparams['exams']=$exams->updateExam($exam, $_POST['id']);
			}
			header("Location: /exams");
		}
		if(isset($request['params']['id'])){
			$id = $request['params']['id'];
			$viewparams['exams']=$exams->getExam($id);
		}else{
			$viewparams = array();
		}
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function deleteAction(){
		$request = $this->request;
		$exams = new Model_Exams();	
		if($_POST){
			if($_POST['borrar']=='Si')
				$viewparams['exams']=$exams->deleteExam($_POST['id']);
			header('Location: /exams');
		}else{
			$id = $request['params']['id'];
			$viewparams['exams']=$exams->getExam($id);
		}
		$this->content=renderView($this->request,$viewparams);
	}

}
