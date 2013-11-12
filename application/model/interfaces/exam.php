<?php
interface Model_Interfaces_Exam
{

	public function readExams();
	public function writeExam($id, $Exam);
	public function readExam($id);
	public function removeExam($id);
}