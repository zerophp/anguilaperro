<?php


function __autoload($class)
{
	$ruta = __DIR__;
	set_include_path(get_include_path() . PATH_SEPARATOR . $ruta);

	include(str_replace('_', '/', $class).".php");
	
}