<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

$config_file="../application/configs/config.ini";

require_once ("../application/autoload.php");

require_once ("../application/model/generalModel.php");




$config=readConfigFile($config_file, APPLICATION_ENV);

$request=getRequest();


	/** New controller logic */
	$controllerName = "Controllers_" . ucfirst($request['controller']); 
	$controller = new $controllerName($request);
	$methodName=strtolower($request['action']) . "Action";
	$controller->$methodName(array());













