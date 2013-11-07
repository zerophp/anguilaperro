<?php
switch($request['action'])
{
	case 'index':
		$viewparams=array();
		$content=renderView($request,$viewparams);
		break;
}

$layoutparams=array('content'=>$content);
echo renderLayout('backend', $layoutparams);