<?php

<<<<<<< HEAD
class Model_Users_UsersMysql implements Model_Interface_Users
=======
class Model_Users_UsersMysql implements Model_Interfaces_Users
>>>>>>> e7065cad2b3dad4c58754ae9e92461c34d1d1737
{
	
	
	private $user;
	
	public function readUsers()
	{
<<<<<<< HEAD

=======
		$users=array();
>>>>>>> e7065cad2b3dad4c58754ae9e92461c34d1d1737
		$sql="SELECT * FROM users";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row=mysqli_fetch_assoc($result))
		{
			$users[]=$row;
		}
		
		return $users;
	}
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
			$sql = "UPDATE users SET
				email='".$user['email']."',
				password='".$user['password']."',
				name='".$user['name']."',				
			WHERE idusers=".$id;
			
			mysqli_query($linkWrite, $sql);
			
			return;
		}
	}
	public function readUser($id)
	{
		$sql="SELECT * FROM users WHERE idusers=".$id;
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		$user=mysqli_fetch_array($result);
		
		return $user;
	}
	public function removeUser($id)
	{
		$sql = "DELETE FROM users WHERE idusers = " . $id;
		$linkWrite= $_SESSION['register']['linkWrite'];
		mysqli_query($linkWrite, $sql);
		
		return;
	}

}