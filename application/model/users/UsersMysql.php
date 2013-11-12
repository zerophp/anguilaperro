<?php

class UsersMysql implements UsersGateway
{
		/**
		 * Method that returns an array with users data
		 * @return The array with users data
		 */
        public function readUsers() {
			$users = array();
			$linkRead = $_SESSION['register']['linkRead'];
			$sql="SELECT * FROM users";
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
        public function writeUser($id, $user) {
			$newId = null;
			$linkWrite = $_SESSION['register']['linkWrite'];
			if ($id == null || readUser($id) == null) {
				$sql="INSERT INTO users SET
							name='".$user['name']."',
							email='".$user['email']."',
							password='".$user['password']."',
							address='".$user['address']."',
							phone='".$user['phone']."',
							cities_idcities=".$user['cities'];        
				mysqli_query($linkWrite, $sql); 
				$newId = mysqli_insert_id($linkWrite);
			} else {
				$sql="UPDATE users SET
							name='".$user['name']."',
							email='".$user['email']."',
							password='".$user['password']."',
							address='".$user['address']."',
							phone='".$user['phone']."',
							cities_idcities=".$user['cities']."
					WHERE idusers=".$id;        
				mysqli_query($linkWrite, $sql);    				
			}
			return $newId;
		}
		
		/**
		 * Method that return the user data
		 * @param $id User identifier
		 * @return The user data or null if the user does not exists
		 */
        public function readUser($id) {			
			$linkRead = $_SESSION['register']['linkRead'];
			$sql="SELECT * FROM users WHERE idusers=".  $id;
			$result=mysqli_query($linkRead,$sql);        
			$user=mysqli_fetch_array($result);
            return $user;
		}
		
		/**
		 * Method that removes the user data
		 * @param $id User identifier
		 */
        public function removeUser($id) {
			$linkWrite = $_SESSION['register']['linkWrite'];
			$sql="DELETE FROM users WHERE idusers=".$id;        
			mysqli_query($linkWrite, $sql);  
			return;
		}
}