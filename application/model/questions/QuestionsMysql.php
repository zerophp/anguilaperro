<?php

class Model_Questions_QuestionsMysql implements Model_Interfaces_Questions
{
	
	public function readQuestions($examId)
	{
		$questions=array();
		$sql="SELECT * FROM questions WHERE exam=" . $examId;
		
		$linkRead= $_SESSION['register']['linkRead'];
		$result=mysqli_query($linkRead,$sql);
		
		while($row = mysqli_fetch_assoc($result))
		{
			$questions[]=$row;
		}
		
		return $questions;
	}
	
	public function writeQuestion($id, $question)
	{
		$linkWrite= $_SESSION['register']['linkWrite'];
		
		if(empty($id))
		{				
			$sql = "INSERT INTO questions SET
					description='".$question['description']."',
					question_difficulty='".$question['difficulty']."',
					question_type='".$question['type']."',
					exam=" . $question['examId'];			
			mysqli_query($linkWrite, $sql);
			$questionId = mysqli_insert_id($linkWrite);
			
			foreach ($question["answers"] as $key => $value) {
				if (!empty($value)) {
					$isCorrect = 0;
					$myValue = $value;
					if ($question["type"] == 3) {
						$isCorrect = 1;
						$myValue = $question['answersCorrect'][0];
					} else if ($question["type"] == 2) {
						if ($key == $question['answersCorrect'][0]) {
							$isCorrect = 1;
						}
					} else {
						if (in_array($key,$question['answersCorrect'])) {
							$isCorrect = 1;
						}
					}
					$sql = "INSERT INTO answers SET
						text='" . $myValue . "',
						is_correct='" . $isCorrect . "',
						question='".$questionId."'";					
					mysqli_query($linkWrite, $sql);
				}	
			}
			return $questionId;
		}
		else
		{
						
			return;
		}
	}
	

}