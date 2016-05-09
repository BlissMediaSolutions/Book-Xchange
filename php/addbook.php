<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/

	include('book.php');

	$booktitle = $_GET['title'];
	$bookisbn = $_GET['isbn'];
	$bookauthor = $_GET['author'];
	$bookpublisher = $_GET['publisher'];
	$bookedition = $_GET['edition'];
	// $bookcondition = $_GET['condition'];
	// $bookcomments = $_GET['comments'];

	$newBook = new Book($booktitle, $bookisbn, $bookauthor, $bookpublisher, $bookedition);
	$writeResult = $newBook->addBook();

	header('Content-type: application/json');
	$returnBody = array( 'result' => $writeResult ? 'ok' : 'bad');

	if ($writeResult === true) {
		$studentMap = $newBook->mapRepresentation();
		$returnBody["user"] = $studentMap;
	}else{
		header('HTTP/1.1 400 Bad Request');
	}
	echo json_encode( $returnBody );
	
?>