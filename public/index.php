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
		//include_once("../application/controllers/Index.php");
		$controller = new Controllers_Index($request);
		$controller->indexAction(array());
	break;
	case 'backend':
		$controller = new Controllers_Backend($request);
		$controller->indexAction(array());
	break;
	case 'users':
		include_once("../application/controllers/Users.php");
	break;
	case 'groups':
		//include_once("../application/controllers/groupsController.php");
		$controller = new Controllers_Groups($request);		
		$controller->indexAction(array());
	break;
	case 'errors':
		include_once("../application/controllers/Errors.php");
	break;
	
	default:
		break;
}












