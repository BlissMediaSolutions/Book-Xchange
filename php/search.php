<?php
	/* Student Registration for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Creates Student Registration. 
			this file called by register.html
			it calls student.php to create a new student/obj & writes it to the db.
*/

	include_once('book.php');

	$searchTerm = $_GET['query'];

	$books = Book::searchBooks($searchTerm);
	$mappedBooks = NULL;
	foreach($books as $book){
		$bookMap = $book->mapRepresentation();
		$xchanges = $book->getXchanges();
		if ($xchanges !== false) {
			$bookMap['xchanges'] = $xchanges;
			if (count($xchanges) > 0) {
				$minPrice = $xchanges[0]["BOOKPRICE"];
				$bookMap['min_price'] = $minPrice;
			}
		}
		$mappedBooks[] = $bookMap;
		// error_log(json_encode());
	}

	// echo 
	// echo json_encode($books)
	// echo json_encode($results);


	header('Content-type: application/json');
	// $returnBody = array( 'result' => $errorEncountered === false ? 'ok' : 'bad');
	$returnBody = array( 'result' => 'ok');

	// if ($errorEncountered !== true) {
		$returnBody["search_results"] = $mappedBooks;
	// }else{
		// header('HTTP/1.1 400 Bad Request');
		// $returnBody["message"] = $errorDescription;
	// }
	echo json_encode( $returnBody );
	// echo json_encode("You searched for " . $searchTerm);
	
?>