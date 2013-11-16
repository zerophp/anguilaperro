<?php

class Controllers_Backend
{

	public $content;
	public $request;

	public function __construct($request)
	{
		if (!isset($_SESSION['user']))
			header("Location: /author/login");
		
		$this->request=$request;
		
	}

	public function indexAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function dashboardAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout('backend', $layoutparams);
	}

	
}


