<?php
/* Book Class for The Book Exchaange
   Last Modified Date: 24/4/2016
   version: 1.0
		1.0 - Initall Book Class creation with some db communication */
		 
	class Book 
	{
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
		
		/* Class functions */
		function setBookID($par){
			$this->bookid = $par;
		}

		function getBookID(){
			return $this->bookid;
		}

		function getBookName(){
			return $this->name;
		}

		function getBookISBN(){
			return $this->isbn;
		}

		function getBookAuthor(){
			return $this->author;
		}

		function getBookPublisher(){
			return $this->publish;
		}

		function getBookEdition(){
			return $this->edit;
		}

		/* Add's a new Book to the database & get's the Book ID from the database */
		function addNewBoooktoDB($bname, $bisbn, $bauthor, $bpublish, $bedit) 
		{
			//var $result;
			$query = "INSERT INTO BOOK (BOOKNAME, BOOKISBN, BOOKAUTHOR, BOOKPUB, BOOKEDIT) VALUES ('$bname', '$bisbn', '$bauthor', '$bpublish', '$bedit')";
			$thisbookID = addBookComms($query);
			setBookID($thisbookID);
		}

		/* Deleting a Book from the Database */
		function deleteBookFromDB($bname, $bisbn, $bauthor, $bpublish, $bedit) {
			var $result
		}

	} /* End Book class */

	function addBookComms($sqlquesry)
	{
		require_once ("settings.php");//connection info 
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
		if (!$conn) 
		{
			echo "<p><font color='red'> Error Connecting to Database </font></p>";
		} else 
		{
			$result = mysqli_query($conn, $sqlquery);
			if(!$result) 
			{
				echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";				
			} else 
			{
				$bookquery = "SELECT MAX(BOOKID) FROM BOOK";
				$newresult = mysqli_query($conn, $bookquery);
				//return $par = mysqli_query($conn, $custquery)
				return mqsqli_fetch_row($newresult);
				//$BookID = mysqli_fetch_row($newresult); 
				mysqli_free_result($newresult);
			}
		}
		mysqli_close($conn);
	}

	//}
?>