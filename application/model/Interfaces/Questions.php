<?php


interface Model_Interfaces_Questions
{
		
	public function readQuestions($examId);
	public function writeQuestion($id, $question);
}