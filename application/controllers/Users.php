<?php

switch($request['action'])
{
	case 'index':
	case 'login':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
	
	case 'logout':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
	
	case 'register':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
	
}

$layoutparams=array('content'=>$content);
echo renderLayout('login', $layoutparams);