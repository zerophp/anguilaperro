<?php

class Bootstrap
{
	private $linkRead;
	private $linkWrite;
	private $config;	
	
	public function __construct($config_file)
	{		
		require_once ("../application/model/generalModel.php");
		$this->config=readConfigFile($config_file, APPLICATION_ENV);		
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
		$controllerName = "Controllers_" . ucfirst($request['controller']);
		$controller = new $controllerName($request);
		$methodName=strtolower($request['action']) . "Action";
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
















