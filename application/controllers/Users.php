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
		
		if($_POST){
			$user = array();
			$user['name'] = $_POST['name'];
			$user['email'] = $_POST['email'];
			$user['password'] = $_POST['password'];
		
			$viewparams['users']=$users->insertUser($user);
		
			header("Location: /users");
		}
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function updateAction(){
		$request = $this->request;
		$users = new Model_Users();
			
		if($_POST){
			$user = array();
			$user['name'] = $_POST['name'];
			$user['email'] = $_POST['email'];
			$user['password'] = $_POST['password'];
			
			$viewparams['users']=$users->updateUser($user,$_POST['id']);
			
			header("Location: /users");
		}
		
		$id = $request['params']['id'];
		$viewparams['users']=$users->getUser($id);
		
		$this->content=renderView($request,$viewparams);
		
	}
		
	public function deleteAction(){
		$request = $this->request;
		$users = new Model_Users();
		if($_POST){
			if($_POST['borrar']=='Si')
				$viewparams['users']=$users->deleteUser($_POST['id']);
			header('Location: /users');
		}else{
			$id = $request['params']['id'];
			$viewparams['users']=$users->getUser($id);
		}
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('backend', $layoutparams);
	}

}
