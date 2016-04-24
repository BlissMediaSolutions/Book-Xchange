<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 24/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/

	require_once('student.php');

	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$studemail = $_GET['email'];
	$studphone = $_GET['phone'];
	$studpass = $_GET['password'];

	$newStudent = new Student(fname, lname, studemail, studphone, studpass);
	$newStudent->addNewStudent();
	echo ('Congratulations ' $fname ' ' $lname ' you are now registered');
?>