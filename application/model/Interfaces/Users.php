<?php


interface Model_Interfaces_Users
{
		
	public function readUsers();
	public function writeUser($id, $user);
	public function readUser($id);
	public function removeUser($id);	
}