<?php

class Bootstrap
{
	
	public $request;
	
	
	
	public function __construct($config)
	{		
		require_once ("../application/model/generalModel.php");
		$config=readConfigFile($config_file, APPLICATION_ENV);		
	
		$this->_configApp();

	}
	
	protected function _request()
	{
		$this->request=getRequest();
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
		$controllerName = "Controllers_" . ucfirst($request['controller']);
		$controller = new $controllerName($request);
		$methodName=strtolower($request['action']) . "Action";
		$controller->$methodName(array());
	}
}
















