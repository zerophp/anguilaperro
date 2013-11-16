<?php

class Model_Exams_ExamsMysql implements Model_Interfaces_Exams
{
	
	public function readExams()
	{
		$exams=array();
		$sql="SELECT * FROM exams" ;
		
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row = mysqli_fetch_assoc($result))
		{
			$exams[]=$row;
		}
		                                                            
		return $exams;
	}
	
	public function writeExam($exam, $id)
	{
		$linkWrite= $_SESSION['register']['linkWrite'];
		
		if(empty($id))
		{				
			$sql = "INSERT INTO exams SET
					topic='".$exam['topic']."',
					difficulty='".$exam['difficulty']."'";			
			mysqli_query($linkWrite, $sql);
			$examId = mysqli_insert_id($linkWrite);
			
			return mysqli_insert_id();
		}
		else
		{
			
			$sql = "UPDATE  exams SET
						topic='".$exam['topic']."',
						difficulty='".$exam['difficulty']."'
					WHERE idexams=".$id;
			mysqli_query($linkWrite, $sql);
			$examId = mysqli_insert_id($linkWrite);	
		
			return;
		}
	}
	
	public function readExam($id)
	{
		$sql="SELECT * FROM exams WHERE idexams=".$id;
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
	
		$exam=mysqli_fetch_assoc($result);
	
		return $exam;
	}
	
	
	public function removeExam($id)
	{
		$sql = "DELETE FROM exams WHERE idexams = " . $id;
		$linkWrite= $_SESSION['register']['linkWrite'];
		mysqli_query($linkWrite, $sql);
	
		return;
	}

}