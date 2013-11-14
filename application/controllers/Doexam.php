<?php

class Controllers_Doexam
{

	public $content;
	public $request;
	protected $layout = 'backend';

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function answerAction($viewparams)
	{
	$questions = new Model_Questions();
	
	//
	//
	
	if ($_POST) {
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
		
			//Update Questions and answers
//			$questions->updateQuestion($this->request['params']['exam'],$this->request['params']['question']);
			//$this->indexAction($viewparams);
		
		} else {
			$viewparams['question']=$questions->readQuestion($this->request['params']['question']);
			$viewparams['answers']=$questions->readAnswers($this->request['params']['question']);
			
			$qarray=$questions->readQuestions($viewparams['question']['exam']);
			$lenqarray=count($qarray);
			for($i=0;$i<$lenqarray;$i++){
				$aux=$qarray[$i];
				if($aux['idquestions']==$this->request['params']['question']['idquestions']){
					if($i==0){
						$nav=array("index"=>$i+1,"total"=>$lenqarray,"prior"=>null,"current"=>$aux['idquestions'],"next"=>$qarray[$i+1]['idquestions']);
					}	
					elseif($i==count($qarray)){
						$nav=array("index"=>$i+1,"total"=>$lenqarray,"prior"=>$qarray[$i-1]['idquestions'],"current"=>$aux['idquestions'],"next"=>null);						
					}
					elseif(1==count($qarray)){
						$nav=array("index"=>$i+1,"total"=>$lenqarray,"prior"=>null,"current"=>$aux['idquestions'],"next"=>null);
					}					
					else{
						$nav=array("index"=>$i+1,"total"=>$lenqarray,"prior"=>$qarray[$i-1]['idquestions'],"current"=>$aux['idquestions'],"next"=>$qarray[$i+1]['idquestions']);						
					}
				}
			}

			$viewparams['nav']=$nav;
			/*echo "<pre>";
			print_r($viewparams);
			echo "</pre>";
				
			echo "<pre>";
			print_r($qarray);
			echo "</pre>";*/
				
			//Get the right answers
			foreach ($viewparams['answers'] as $key=>$value){
				if($value['is_correct']==1)
					$right[]=$key + 1;
			}
 
			$this->content=renderView($this->request,$viewparams);
		}
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout($this->layout, $layoutparams);
	}
}
