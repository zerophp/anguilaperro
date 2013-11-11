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
		
		require_once ("/Model/generalModel.php");
		$this->config=readConfigFile($config_file, APPLICATION_ENV);			
		$this->_configApp();
	}
	
	protected function _configApp()
	{
		$this->_request();
		$this->_router();
		$this->_session();
		$this->_register();
		$this->_db();
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
		$a = session_id();
		if(empty($a)) 
			session_start();
		$this->session = $a;
	}
	
	protected function _register()
	{
		$_SESSION['register']=array();
	}
	
	
	public function setRegisterVar($name, $value)
	{
		$_SESSION['register'][$name]=$value; 
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
		
		$this->setRegisterVar('linkWrite', $this->linkWrite);
		$this->setRegisterVar('linkRead', $this->linkRead);
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




