<?php

class Model_Groups_GroupsMysql implements Model_Interfaces_Groups
{
	
	
	private $group;
	
	public function readGroups()
	{
		$groups=array();
		$sql="SELECT * FROM groups";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row=mysqli_fetch_assoc($result))
		{
			$groups[]=$row;
		}
		
		return $groups;
	}
	public function writeGroup($group, $id = "")
	{
		$linkWrite= $_SESSION['register']['linkWrite'];
		
		if(empty($id))
		{
			$sql = "INSERT INTO groups SET
					name='".$group['name']."',
					group_state= 2";
			
			mysqli_query($linkWrite, $sql);
			
			return mysqli_insert_id();
		}
		else
		{
			$sql = "UPDATE groups SET
				name='".$group['name']."',				
			WHERE idgroups=".$id;
			
			mysqli_query($linkWrite, $sql);
			
			return;
		}
	}
	public function readGroup($id)
	{
		$sql="SELECT * FROM groups WHERE idgroups=".$id;
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		$group=mysqli_fetch_array($result);
		
		return $group;
	}
	public function removeGroup($id)
	{
		$sql = "DELETE FROM groups WHERE idgroups = " . $id;
		$linkWrite= $_SESSION['register']['linkWrite'];
		mysqli_query($linkWrite, $sql);
		
		return;
	}
}