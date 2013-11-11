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

<<<<<<< HEAD
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
=======

	$controllerName = "Controllers_" . ucfirst($request['controller']); 
	$controller = new $controllerName($request);
	$methodName=strtolower($request['action']) . "Action";
	$controller->$methodName(array());
/*	
switch ($request['controller']) {
   case 'index':
		$controller = new Controllers_Index($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
	break;
	case 'backend':
		$controller = new Controllers_Backend($request);
		$methodName=$request['action'] . "Action";
		$controller->$methodName(array());
>>>>>>> 2fa71c001a4099b4d6c1f7bab5603b25f6095926
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
}*/












