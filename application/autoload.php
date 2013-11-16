<?php


function __autoload($class)
{
	$parts = explode('_', $class);
		
	foreach($parts as $key => $value)
	{		
		if($value=='Controllers')
			$value="controllers";
		else if($value=='Model')
			$value='model';
		else 
			$value=ucfirst($value);
		$parts[$key]=$value;
	}	
	$parts = implode('/',$parts);
	include_once($parts.".php");	
}
