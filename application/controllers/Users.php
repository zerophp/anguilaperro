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
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function loginAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function logoutAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function registerAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('login', $layoutparams);
	}
}
