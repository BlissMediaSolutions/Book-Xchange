<?php
	/* Student Login for The Book Exchaange
   Last Modified Date: 09/05/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/
	include_once('student.php');

	$studID = $_GET['studid'];
	$studpass = $_GET['password'];

	error_log($studID . ' ' . $studpass);

	$newStudent = new Student($studID, $studpass);
	$loginResult = $newStudent->findStudent($newStudent->getStudentID(), $newStudent->getPassword());
	$returnBody = array( 'result' => $loginResult ? 'ok' : 'bad');
	
	if ($loginResult === true) {
		$returnBody["user"] = $newStudent->mapRepresentation();
	}
	echo json_encode( $returnBody );
	
?>