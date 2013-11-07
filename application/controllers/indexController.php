<?php

switch($request['action'])
{
	case 'index':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
	
	case 'about':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
		
	case 'contact':
		$viewparams=array();
		$content=renderView($request,$viewparams);
	break;
}

$layoutparams=array('content'=>$content);
echo renderLayout('backend', $layoutparams);