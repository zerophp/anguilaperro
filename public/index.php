<?php

// Define application environment
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV',
		(getenv('APPLICATION_ENV') ?
				getenv('APPLICATION_ENV') : 'production'));

$config_file="../application/configs/config.ini";
require_once ("../application/autoload.php");

$boostrap = new Boostrap($config);
$boostrap->run();
















