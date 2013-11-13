<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

set_include_path(get_include_path() . PATH_SEPARATOR . 
__DIR__.'/../library');


$config_file="../application/configs/config.ini";
require_once ("../application/autoload.php");


$boostrap = new Bootstrap($config_file);
$boostrap->_run();
