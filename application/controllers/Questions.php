<?php

class Controllers_Questions
{

	public $content;
	public $request;
	protected $layout = 'backend';

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function createAction($viewparams)
	{
		$questions = new Model_Questions();
		if ($_POST) {
			//INSERT Questions and answers
			$questions->insertQuestion($this->request['params']['exam']);
			$this->indexAction($viewparams);
		} else {
			$viewparams['examID']=$this->request['params']['exam'];		
			$this->content=renderView($this->request,$viewparams);
		}
	}
	
	public function indexAction($viewparams)
	{		
		$questions = new Model_Questions();
		$viewparams['questions'] = $questions->readQuestions($this->request['params']['exam']);
		$viewparams['examID']=$this->request['params']['exam'];
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function removeAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function updateAction($viewparams)
	{
	$questions = new Model_Questions();
	if ($_POST) {
			//Update Questions and answers
			$questions->updateQuestion($this->request['params']['exam'],$this->request['params']['question']);
			$this->indexAction($viewparams);
			
		} else {
			$viewparams['examID']=$this->request['params']['exam'];		
			$viewparams['questionID']=$this->request['params']['question'];
			$viewparams['question']=$questions->readQuestion($this->request['params']['question']);
			$viewparams['answers']=$questions->readAnswers($this->request['params']['question']);
			
			
				
			//Get the right answers
			foreach ($viewparams['answers'] as $key=>$value){
				if($value['is_correct']==1)
					$right[]=$key + 1;
			}
			$viewparams['right']=implode(',', $right);
 
			$this->content=renderView($this->request,$viewparams);
		}
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout($this->layout, $layoutparams);
	}
}
