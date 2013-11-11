<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

$config_file="../application/configs/config.ini";
require_once ("../application/autoload.php");

<<<<<<< HEAD
$boostrap = new Boostrap($config_file);
$boostrap->run();















=======
$bootstrap = new Bootstrap($config_file);
$bootstrap->_run();
>>>>>>> 5b6a749b8d203a2be85e014433a62171e6f32b1f

