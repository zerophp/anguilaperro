<?php

class Controllers_Authors
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function loginAction($viewparams)
	{
		
		$request = $this->request;
		$authors = new Model_Authors();
			
		if($_POST){
			
			$author=$authors->login($_POST['email'],$_POST['password']);
			
			if (is_null($author)){
				$viewparams['message'] = "Error de autenticación";
			}else{

				$_SESSION['user'] = $author; 

				header("Location: /backend");
			}
		
		}else{

			$viewparams = array();
			
		}
		
		$this->content=renderView($this->request,$viewparams);
		
		
	}
	
	
	public function logoutAction()
	{
		unset($_SESSION['user']);
		header("Location: /index");
	}
	
	public function registerAction($viewparams)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout('login', $layoutparams);
	}
}
