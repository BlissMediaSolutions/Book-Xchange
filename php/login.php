<?php
	/* Student Login for The Book Exchaange
   Last Modified Date: 09/05/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/
	include('student.php');

	$studID = $_GET['studid'];
	$studpass = $_GET['password'];

	$newStudent = new Student($studID, $studpass);
	$loginResult = $newStudent->findStudent($newStudent->StudID, $newStudent->password);
	$returnBody = array( 'result' => $loginResult ? 'ok' : 'bad');
	
	if ($loginResult === true) {
		$returnBody["user"] = $newStudent->mapRepresentation();
	}
	echo json_encode( $returnBody );
	
?>