<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

require_once ("../application/model/generalModel.php");

require_once ("../application/autoload.php");

$config_file="../application/configs/config.ini";
$config=readConfigFile($config_file, APPLICATION_ENV);

$request=getRequest();

switch ($request['controller'])
{
	case 'users':
		include_once("../application/controllers/usersController.php");
	break;
	case 'groups':
		//include_once("../application/controllers/groupsController.php");
		$controller = new Controllers_Groups($request);		
		$controller->indexAction(array());
	break;
	case 'index':
		include_once("../application/controllers/indexController.php");
	break;
	default:
		break;
}












