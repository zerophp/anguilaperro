<?php

class Bootstrap
{
	private $session;
	public function __construct($config)
	{		
		require_once ("../application/model/generalModel.php");
		$config=readConfigFile($config_file, APPLICATION_ENV);		
		$request=getRequest();
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
		$a = session_id();
		if(empty($a)) session_start();
		$this->$session = $a;
	}
	
	public function getSessionId(){
		return $this->$session;
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
















