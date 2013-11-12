<?php

class Model_Users_UsersMysql implements Model_Interfaces_UsersGateway
{
	private $user;
	
	public function readUsers(){
		//throw sql against database
		$sql="SELECT * FROM users";
		//return users array
		return mysql_query($link,$sql);
	}
	public function writeUser($id, $user){

	}
	public function readUser($id){

	}
	public function removeUser($id){

	}
}