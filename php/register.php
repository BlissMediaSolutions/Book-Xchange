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

	//$StudID = $_GET['studid'];
	//$fname = $_GET['fname'];
	//$lname = $_GET['lname'];
	//$studemail = $_GET['email'];
	//$studphone = $_GET['phone'];

	$StudID = "1060325";
	$fname = "Danielle";
	$lname = "Walker";
	$studemail = "danielle@bliss.net.au";
	$studphone = "1234567890";
	$studpass = "password";
	$uniqueUID = hash_hmac('sha512', $studemail, 'fooCoo-n4wo&ung_ee4kaekeXaesae');
	echo $uniqueUID;

	$newStudent = new Student($StudID, $fname, $lname, $studemail, $studphone, $studpass);
	$query = "INSERT INTO STUDENT (STUDID, UUID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ($StudID, '$uniqueUID', '$fname', '$lname', '$studemail', '$studphone', '$studpass');";
			$sqltable = "STUDENT";
	$writeResult = $newStudent->WriteToDbase($sqltable, $query);

	if ($writeResult === true) {
		echo "Congratulations ". $fname ." ".$lname ." you have been registered";
	}else{
		echo "Database connection failure.";
	}
	
?>