<?php
/* Book Class for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.0
		1.0 - Initall Book Class creation with some db communication 
		1.1 - Add set functions    */
		 
	class Book 
	{
		require ("dbase.php");

		/* Class variables */
		var $bookid;								/* the Book ID number in database */
		var $name;									/* The Book Name */
		var $isbn;									/* The Book ISBN */
		var $author;								/* The book author */
		var $publish;								/* The book publisher */
		var $edit;									/* The book edition */
		
		/* Class Constructor */
		function _construct ($bname, $bisbn, $bauthor, $bpublish, $bedit)
		{
			$this->name = $bname;
			$this->isbn = $bisbn;
			$this->author = $bauthor;
			$this->publish = $bpublish;
			$this->edit = $bedit;
		}

		/* Class Destructor */
		function _destruct(){

		}
		
		/* Class set/get functions */
		function setBookID($par){
			$this->bookid = $par;
		}

		function getBookID(){
			return $this->bookid;
		}

		function setBookName($par){
			$this->name = $par;
		}

		function getBookName(){
			return $this->name;
		}

		function setBookISBN($par){
			$this->isbn = $par;
		}

		function getBookISBN(){
			return $this->isbn;
		}

		function setBookAuthor($par){
			$this->author = $par;
		}

		function getBookAuthor(){
			return $this->author;
		}

		function setBookPublisher($par){
			$this->publish = $par;
		}

		function getBookPublisher(){
			return $this->publish;
		}

		function setBookEdition($par){
			$this->edit = $par;
		}

		function getBookEdition(){
			return $this->edit;
		}

		/* Add's a new Book to the database & get's the Book ID from the database */
		function addBoook($bname, $bisbn, $bauthor, $bpublish, $bedit) 
		{
			$sqltable = "BOOK";
			$query = "INSERT INTO BOOK (BOOKNAME, BOOKISBN, BOOKAUTHOR, BOOKPUB, BOOKEDIT) VALUES ('$bname', '$bisbn', '$bauthor', '$bpublish', '$bedit')";
			
			WriteToDbase($sqltable, $query);			
		}

		/* Deleting a Book from the Database */
		function deleteBook($bname, $bisbn, $bauthor, $bpublish, $bedit) {
			$sqltable = "BOOK";
			$query = "DELETE FROM BOOK WHERE BOOKID = '$this->BOOKID'";
		}

		function updateBook($this->bookid){

		}

		function findBookInDB()
		{}

	} /* End Book class */

	//function addBookComms($sqlquesry)
	//{
	//	require_once ("settings.php");//connection info 
	//	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	//	if (!$conn) 
	//	{
	//		echo "<p><font color='red'> Error Connecting to Database </font></p>";
	//	} else 
	//	{
	//		$result = mysqli_query($conn, $sqlquery);
	//		if(!$result) 
	//		{
	//			echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";			//	//
	//		} else 
	//		{
	//			$bookquery = "SELECT MAX(BOOKID) FROM BOOK";
	//			$newresult = mysqli_query($conn, $bookquery);
	//			//return $par = mysqli_query($conn, $custquery)
	//			return mqsqli_fetch_row($newresult);
	//			//$BookID = mysqli_fetch_row($newresult); 
	//			mysqli_free_result($newresult);
	//		}
	//	}
	//	mysqli_close($conn);
	//}

	//}
?>