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
		$controller = new Controllers_Index($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
	break;
	case 'backend':
		$controller = new Controllers_Backend($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
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
	case 'errors':
		$controller = new Controllers_Errors($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
		break;
	
	default:
		break;
}












