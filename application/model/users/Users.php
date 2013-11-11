<?php

class Model_Users extends Users_Tablegat eway
{
	public function __construct()
	{
		$adapter = $_SESSION['register']['adapter'];
		instanciar adaptador
		users_$adapter implements UsersGateway
	}
	
	public function getUsers()
	{
		$u = new users_adapter()
		$u->getUsers();
	}
}