<?php

class Model_Users_UsersMysql implements Model_Interfaces_UsersGateway
{
	private $user;
	
	public function readUsers(){
		//throw sql against database
		$sql="SELECT a.idusers,a.name,a.email,a.password,b.state 
			  FROM users a,user_states b 
			  WHERE a.user_state=b.iduser_state";
		
		$r=mysqli_query($_SESSION['register']['linkRead'],$sql);
		while($row = mysqli_fetch_assoc($r)) {
		   $users[]=$row;
		
		//return users array		   
		return $users;
}		
	}
	public function writeUser($id, $user){

	}
	public function readUser($id){

	}
	public function removeUser($id){

	}
}