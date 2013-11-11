<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

$config_file="../application/configs/config.ini";
require_once ("../application/autoload.php");

$bootstrap = new Bootstrap($config_file);
$bootstrap->_run();

