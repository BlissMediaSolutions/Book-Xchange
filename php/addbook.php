<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/

	include_once('book.php');
	include_once('student.php');
	include_once('xchange.php');
	// include_once('dbase.php');

	$booktitle = $_GET['title'];
	$bookisbn = $_GET['isbn'];
	$bookauthor = $_GET['author'];
	$bookpublisher = $_GET['publisher'];
	$bookedition = $_GET['edition'];
	$bookprice = 10;
	$bookcondition = 3;
	$uuid = $_GET['uuid'];
	// $bookcondition = $_GET['condition'];
	// $bookcomments = $_GET['comments'];

	$newBook = new Book($bookisbn);
	$bookResult = $newBook->findBook($newBook->getBookISBN());

	if (!$bookResult) {
		$newBook = new Book($booktitle, $bookisbn, $bookauthor, $bookpublisher, $bookedition);
		$bookResult = $newBook->addBook();
	}

	// haven't created xchange yet.
	$errorEncountered = false;
	$errorDescription = "";

	// only add an Xchange item if the book was created or exists.
	if ($bookResult === true || $newBook->findBook($bookisbn)) {
		// create x-change
		$student = new Student($uuid);

		if ($student->lookupStudentFromUUID()) {
			$listing = new Xchange($student->getStudentID(), $newBook->getBookID(), $bookcondition, $bookprice, null, null, 0, 0);
			if (!$listing->addXchange()) {
				$errorEncountered = true;
				$errorDescription = "Unable to create xchange";
			}
		}else{
			/*Invalid auth*/
			$errorEncountered = true;
			$errorDescription = "Invalid authorisation token.";
		}
	}else{
		$errorDescription = "Could not add new book.";
		error_log($errorDescription);
		$errorEncountered = true;
	}
	// error_log($uuid);

	header('Content-type: application/json');
	$returnBody = array( 'result' => $errorEncountered === false ? 'ok' : 'bad');

	if ($errorEncountered !== true) {
		// $bookMap = $newBook->mapRepresentation();
		// $returnBody["user"] = $bookMap;
		$returnBody["message"] = "Listing added successfully.";
	}else{
		header('HTTP/1.1 400 Bad Request');
		$returnBody["message"] = $errorDescription;
	}
	echo json_encode( $returnBody );
	
?>