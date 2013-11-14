<?php
class Controllers_DoExam
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function indexAction($viewparams)
	{
		$exams = new Model_DoExam();
		//Eliminar despues
		$email = "anguilaperro@gmail.com";
		if (isset($_SESSION['user'])) {
			$email = $_SESSION['user']['email'];
		}
		$viewparams['exams'] = $exams->readExams($email);
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function startExamAction($viewparams) {
		$questions = new Model_Questions();
		$firstQuestionId = $questions->firstQuestionId($exam);
		header("Location:/doexam/answer/questionid/" . $firstQuestionId);
	}

	public function answerAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout('backend', $layoutparams);
	}
}