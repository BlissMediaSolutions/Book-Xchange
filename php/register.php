<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/
	include('student.php');

	//$StudID = $_GET['studid'];
	//$fname = $_GET['fname'];
	//$lname = $_GET['lname'];
	//$studemail = $_GET['email'];
	//$studphone = $_GET['phone'];
	//$studpass = $_GET['password'];

	$StudID = "1060325";
	$fname = "Danielle";
	$lname = "Walker";
	$studemail = "danielle@bliss.net.au";
	$studphone = "1234567890";
	$studpass = "password";

	$newStudent = new Student($StudID, $fname, $lname, $studemail, $studphone, $studpass);
	$query = "INSERT INTO STUDENT (STUDID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ($StudID, '$fname', '$lname', '$studemail', '$studphone', '$studpass');";
			$sqltable = "STUDENT";
	$newStudent->WriteToDbase($sqltable, $query);
	
	echo "Congratulations ". $fname ." ".$lname ." you have been registered";
	
?>