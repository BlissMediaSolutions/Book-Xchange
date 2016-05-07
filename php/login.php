<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/
	include('student.php');

	// $studpass = $_GET['password'];
	// $repeatPass = $_GET['repeatPassword'];
	// if ($studpass !== $repeatPass) {
	// 	echo "Password confirmation does not match.";
	// 	exit;
	// }

	$studemail = $_GET['email'];
	$studpass = $_GET['password'];

	$newStudent = new Student($studemail, $studpass);
	$loginResult = $newStudent->getAuthenticated();
	$returnBody = array( 'result' => $loginResult ? 'ok' : 'bad');
	if ($loginResult === true) {
		$returnBody["user"] = $newStudent->mapRepresentation();
	}
	echo json_encode( $returnBody );

	// $query = "INSERT INTO STUDENT (STUDID, UUID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ($StudID, '$uniqueUID', '$fname', '$lname', '$studemail', '$studphone', '$studpass');";
	// 		$sqltable = "STUDENT";
	// $writeResult = $newStudent->WriteToDbase($sqltable, $query);
	// if ($writeResult === true) {
	// 	echo "Congratulations ". $fname ." ".$lname ." you have been registered";
	// }else{
	// 	echo "Database connection failure.";
	// }
	
?>