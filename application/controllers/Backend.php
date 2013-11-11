<?php

switch($request['action'])
{
	case 'index':
	case 'dashboard':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
	
	
}

$layoutparams=array('content'=>$content);
echo renderLayout('backend', $layoutparams);