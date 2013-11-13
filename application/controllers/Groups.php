<?php

class Controllers_Groups
{

	public $content;
	public $request;
	
	public function __construct($request)
	{
		$this->request=$request;
	}
	
	public function indexAction($viewparams)
	{		
		$groups = new Model_Groups();

		if(isset($this->request['params']['idgroups'])) {
			$viewparams['group']=$groups->getGroup($this->request['params']['idgroups']);
		}
		
		$viewparams['groups']=$groups->getGroups();
		$this->content=renderView($this->request,$viewparams);
	}
	
	public function addGroupAction($viewparams)
	{
		
		$request = $this->request;
		$groups = new Model_Groups();
		if($_POST){
			$group = array();
			$group['idgroups'] = $_POST['idgroups'];
			$group['name'] = $_POST['name'];
			$group['group_state'] = $_POST['group_state'];
			
			if(empty($_POST['idgroups'])){
				$viewparams['group']=$groups->insertGroup($group);
			}else{
				$viewparams['group']=$groups->updateGroup($group,$_POST['idgroups']);
			}
		}
		header("Location: /groups");
	}
		
	
	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content, 'request'=>$this->request);
		echo renderLayout('backend', $layoutparams);
	}	
}