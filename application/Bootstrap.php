<?php

class Bootstrap
{


	private $linkRead;
	private $linkWrite;
	private $config;	
	private $session;	
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
		$a = session_id();
		if(empty($a)) session_start();
		$this->session = $a;
	}
	
	public function getSessionId(){
		return $this->session;
	}
	
	protected function _db()
	{
		$this->linkRead = mysqli_connect($this->config['database.server'], $this->config['database.username'], $this->config['database.password']);
		mysqli_select_db($this->linkRead, $this->config['database.db']);
		$this->linkWrite = mysqli_connect($this->config['database.server'], $this->config['database.username'],$this->config['database.password']);
		mysqli_select_db($this->linkWrite, $this->config['database.db']);		
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
	
	/**
	 * The data model link to read data
	 * @return The link
	 */
	public function getLinkRead() {
		return $this->linkRead;
	}
	
	/**
	 * The data model link to write data
	 * @return The write
	 */
	public function getLinkWrite() {
		return $this->linkWrite;
	}
}




