<?php

class UsersMysql implements UsersGateway
{
	
	
	private $user;
	
	public function readUsers();
	public function writeUser($id, $user);
	public function readUser($id);
	public function removeUser($id);
}