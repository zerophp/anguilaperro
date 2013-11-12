<?php

class UsersMysql implements UsersGateway
{
	
	
	private $user;
	
	public function readUsers()
	{
		
		
		
		//conection:
		$link = mysqli_connect("myhost","root","","anguilaperro") or die("Error " . mysqli_error($link));
		
		//consultation:
		
		$query = "SELECT idusers FROM anguilaperro.users" or die("Error in the consult.." . mysqli_error($link));
		
		//execute the query.
		
		$user = $link->query($query);
		
		//display information:
		
		while($row = mysqli_fecth_array($user)) {
			echo $row["idusers"] . "<br>";
		}
		
	}
	
	public function writeUser($id, $user) {
		
		foreach($user as $key => $value)
		{
			if($key==$user[$id])
			{
				///Escribimos en el interior del array.
			}
			
		}	
	}
	
	public function readUser($id)
	{
		return $user($id);	
	}
	
	
	
	public function removeUser($id){
		echo(var_dump($user));
		unset($user($id));
		echo(var_dump($user));
		return;
	}
		
	
}