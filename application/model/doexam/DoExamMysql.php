<?php

class Model_DoExam_DoExamMysql implements Model_Interfaces_DoExam
{
	
	public function readExams($userEmail)
	{
		$exams=array();
		$sql="SELECT idexams,ini_date, end_date, topic, ghu.groups_idgroups as id_curso, mark, 
			CASE exam_state 
		    WHEN 2 THEN (CASE WHEN ed.established_exams_idestablished_exams
				IS NULL THEN 0
		        ELSE 2
		        END) 
		    ELSE (CASE WHEN ed.established_exams_idestablished_exams
				IS NULL THEN (CASE WHEN (end_date > curdate()) THEN 1 ELSE 0 END)
		        ELSE 2
		        END)  
				  END AS state
				FROM groups_has_users ghu,  established_exams eex, exams, users
				LEFT JOIN exam_done ed ON (ed.users_idusers = idusers)  
				 WHERE email='" . $userEmail . "' and ghu.users_idusers = idusers
				 AND eex.group = ghu.groups_idgroups and idexams = eex.exam 
				AND (ed.established_exams_idestablished_exams = eex.idestablished_exams OR 
				ed.established_exams_idestablished_exams IS NULL)";
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row = mysqli_fetch_assoc($result))
		{
			$exams[]=$row;
		}
		return $exams;
	}
}