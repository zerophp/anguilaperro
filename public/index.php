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

switch ($request['controller'])
{
	
	case 'index':
		include_once("../application/controllers/Index.php");
	break;
	case 'backend':
		include_once("../application/controllers/Backend.php");
	break;
	case 'users':
		$controller = new Controllers_Users($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
	break;
	case 'groups':
		//include_once("../application/controllers/groupsController.php");
		$controller = new Controllers_Groups($request);		
		$controller->indexAction(array());
	break;
	
	default:
		break;
}












