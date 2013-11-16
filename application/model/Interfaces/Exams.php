<?php


interface Model_Interfaces_Exams
{
		
	public function readExam($id);
	public function readExams();
	
	public function writeExam($exam, $id);
	public function removeExam($id);
}