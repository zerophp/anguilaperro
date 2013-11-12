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
			$sql = "INSERT INTO users SET
					email='".$user['email']."',
					password='".$user['password']."',
					name='".$user['name']."',
					user_state= 2";
			
			mysqli_query($linkWrite, $sql);
			
			return mysqli_insert_id();
		}
		else
		{
			//TODO Tener en cuenta el cambio de password
// 			echo "<pre>";
// 			print_r($user);
// 			echo "</pre>";
// 			die;
			$sql = "UPDATE users SET
				email='".$user['email']."',
				name='".$user['name']."'				
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
}