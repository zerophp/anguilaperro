<?php

class Controllers_Errors
{

	public $content;
	public $request;

	public function __construct($request)
	{
		$this->request=$request;
	}

	public function errorAction($request)
	{
		$this->content=renderView($this->request,$viewparams);
	}

	public function __destruct()
	{
		$layoutparams=array('content'=>$this->content);
		echo renderLayout('backend', $layoutparams);
	}
}
