<?php

class Controllers_Users
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function indexAction($viewparams)
	{
		$users = new Model_Users();		
		$viewparams['users']=$users->getUsers();
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('backend', $layoutparams);
	}
	

}
