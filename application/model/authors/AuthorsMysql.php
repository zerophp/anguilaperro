<?php

class Model_Authors_AuthorsMysql implements Model_Interfaces_Authors
{
	private $user;
	
	/**
	 * Method that returns an array with user data
	 * @param $email
	 * @param $password
	 * @return The array with user data
	*/
	public function login($email, $password)
	{
		$sql="SELECT name, email FROM users WHERE email='".$email . "' AND password='" . $password . "'";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		if (count($result)==1) {
			$user=mysqli_fetch_assoc($result);
		}else{
			$user = null;
		}
		
		return $user;
	}
	
}