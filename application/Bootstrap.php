<?php

class Bootstrap
{
	
	public $request;
	
	public function __construct($config_file)
	{		
		
		require_once ("/model/generalModel.php");
		$config=readConfigFile($config_file, APPLICATION_ENV);		
		$this->request=getRequest();
		$this->_configApp();
		

	}
	
	protected function _request()
	{
		
	}
	
	protected function _router()
	{
		
	}
	
	protected function _session()
	{
		
	}
	
	protected function _db()
	{
		
	}
	
	protected function _configApp()
	{
		$this->_request();
		$this->_router();
		$this->_session();
		$this->_db();
	}
	
	public function _run()
	{
		/** New controller logic */
		
		$controllerName = "Controllers_" . ucfirst($this->request['controller']);
		$controller = new $controllerName($this->request);
		$methodName=strtolower($this->request['action']) . "Action";
		$controller->$methodName(array());
		
	}
}




