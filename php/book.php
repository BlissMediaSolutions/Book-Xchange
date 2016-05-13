<?php
/* Book Class for The Book Exchaange
   Last Modified Date: 06/05/2016
   version: 1.0
		1.0 - Initall Book Class creation with some db communication 
		1.1 - Add set functions    */
		 
	include('dbase.php');

	class Book extends dbase
	{
		
		/* Class variables */
		private $bookid;								/* the Book ID number in database */
		private $name;									/* The Book Name */
		private $isbn;									/* The Book ISBN */
		private $author;								/* The book author */
		private $publish;								/* The book publisher */
		private $edit;									/* The book edition */
		
		/* Main Class Constructor 					*/
		/* Note: as PHP doesnt allow overloading constructors this hack/woraround was used to overload the constructor */
		public function __construct ()
		{
			$get_arguments       = func_get_args();
	        $number_of_arguments = func_num_args();

	        // call a constructor in the format of __constructX, where X is the number of agruments.
	        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
	            call_user_func_array(array($this, $method_name), $get_arguments);
	        }else{
	        	error_log("Undefined function: " . '__construct' . $number_of_arguments . '  in class: ' . get_class($this), 0);
	        }
		}

		/* Overloaded Constructor */
		function __construct5 ($bname, $bisbn, $bauthor, $bpublish, $bedit)
		{
			$this->name = $bname;
			$this->isbn = $bisbn;
			$this->author = $bauthor;
			$this->publish = $bpublish;
			$this->edit = $bedit;
		}

		/* Overloaded Constructor */
		function __construct1 ($bisbn)
		{
			$this->isbn = $bisbn;
		}

		/* Class Destructor */
		function __destruct(){

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

		function mapRepresentation(){
			return array( 
				'title' => $this->name, 
				'isbn' => $this->isbn, 
				'author' => $this->author, 
				'publisher' => $this->publish, 
				'edition' => $this->edit
			);
		}

		/* Add's a new Book to the database */
		function addBook() 
		{
			$sqltable = "BOOK";
			$query = "INSERT INTO BOOK (BOOKNAME, BOOKISBN, BOOKAUTHOR, BOOKPUB, BOOKEDIT) VALUES ('$this->name', '$this->isbn', '$this->author', '$this->publish', '$this->edit')";
			return $this->WriteDelDbase($sqltable, $query);		
		}

		/* Deleting a Book from the Database */
		function deleteBook($par) 
		{
			$sqltable = "BOOK";
			$query = "DELETE FROM BOOK WHERE BOOKID = '$par'";
			WriteDelDbase($sqltable, $query);
		}

		function updateBook($par)
		{

		}

		function findBookInDB(/*$this->bookid*/)
		{}

		function findBook($isbn){
			$sqltable = "BOOK";
			$query = "SELECT * FROM BOOK WHERE BOOKISBN='$isbn'";
			return $this->readFromDbase($sqltable, $query);
		}

	} /* End Book class */

	
?>