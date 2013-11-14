<?php

class Model_Users_UsersMysql implements Model_Interfaces_Users
{
	private $user;
	
	/**
	 * Method that returns an array with users data
	 * @return The array with users data
	*/
	public function readUsers()
	{
		$users=array();
		$sql="SELECT * FROM users";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row=mysqli_fetch_assoc($result))
		{
			$users[]=$row;
		}
		
		return $users;
	}
	
	/**
	 * Method that updates the user data if the user exists or inserts the user if $id is null or the user does not exist
	 * @param $id User identifier or null
	 * @param $user User data
	 * @return Returns null if the user has been updated or the new user id if the user has been created
	*/
	public function writeUser($user, $id = "")
	{
		$linkWrite= $_SESSION['register']['linkWrite'];
		
		if(empty($id))
		{
// 			$sql = "INSERT INTO users SET
// 					email='".$user['email']."',
// 					password='".$user['password']."',
// 					name='".$user['name']."',
// 				 	display_name='".$user['display_name']."',
// 				 	token = null,
// 				 	timestamp = null,
// 					user_state= 2";

			$sql = "INSERT INTO users SET
					email='".$user->getEmail()."',
					password='".$user->getPassword()."',
					name='".$user->getName()."',
				 	display_name='".$user->getDisplay_name()."',
				 	token = '".$user->getToken()."',
				 	timestamp = '".$user->getTimestamp()."',
					user_state= 2";
			
			
			mysqli_query($linkWrite, $sql);
			
			return;
		}
		else
		{
			$sql = "UPDATE users SET
				email='".$user['email']."',
				password='".$user['password']."',
				name='".$user['name']."',
				display_name='".$user['display_name']."'				
			WHERE idusers=".$id;
			
			mysqli_query($linkWrite, $sql);
			
			return;
		}
	}
	
	/**
	 * Method that return the user data
	 * @param $id User identifier
	 * @return The user data or null if the user does not exists
	*/
	public function readUser($id)
	{
		$sql="SELECT * FROM users WHERE idusers=".$id;
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		$user=mysqli_fetch_assoc($result);
		
		return $user;
	}
	
	/**
	 * Method that removes the user data
	 * @param $id User identifier
	*/
	public function removeUser($id)
	{
		$sql = "DELETE FROM users WHERE idusers = " . $id;
		$linkWrite= $_SESSION['register']['linkWrite'];
		mysqli_query($linkWrite, $sql);
		
		return;
	}
	
	public function verifyUser($email,$token){
		$sql = "SELECT timestamp, idusers, email, password FROM users WHERE email = '".$email."' AND token = '".$token."'";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		return mysqli_fetch_object($result);
	}

}