<?php
/* Student Class for The Book Exchaange
   Last Modified Date: 06/05/2016
   version: 1.3
		1.0 - Initall Student Class creation 
		1.1 - Adding db communication to write Student to db 
		1.2 - Create Dbase class to handle all db query, modify student in accordance
		1.3 - Allow retrieval of a map/array representation of a student object.  */
 	//
	include_once('dbase.php');
	
	class Xchange extends dbase
	{

		/* Class variables */
		private $StudID;
		private $bookid;
		private $condid;
		private $bookprice;
		private $bookimg;
		private $bookres;
		private $bookdate;
		private $booksold;

		/* Main Class Constructor 					*/
		/* Note: as PHP doesnt allow overloading constructors this hack/woraround was used to overload the constructor */
		public function __construct ($StudID, $bookid, $condid, $bookprice, $bookimg, $bookres, $bookdate, $booksold)
		{
			$this->StudID = $StudID;
			$this->bookid = $bookid;
			$this->condid = $condid;
			$this->bookprice = $bookprice;
			$this->bookimg = $bookimg;
			$this->bookres = $bookres;
			$this->bookdate = $bookdate;
			$this->booksold = $booksold;
		}

		/* Class Destructor */
		function __destruct(){

		}
		
		/* Class set/get functions */
		function getStudentID(){
			return $this->StudID;
		}

		function getBookID(){
			return $this->bookid;
		}

		function getBookPrice(){
			return $this->bookprice;
		}

		function getBookImage(){
			return $this->bookimg;
		}
		function getBookRes(){
			return $this->bookres;
		}

		function getBookDate(){
			return $this->bookdate;
		}

		function getBookSold(){
			return $this->booksold;
		}

		function mapRepresentation(){
			return array( 
				// 'studid' 	=> 	$this->StudID, /*Don't want to divulge info about seller in public API Though we may share emails...?*/
				'bookid' 	=> 	$this->bookid, 
				'bookprice' => 	$this->bookprice, 
				'condid' 	=>	$this->condid,
				'bookimg' 	=> 	$this->bookimg, 
				'bookres' 	=> 	$this->bookres, 
				'bookdate' 	=> 	$this->bookdate,
				'booksold' 	=> 	$this->booksold 
			);
		}

		//Add new Student to Database
		function addXchange(){
			$sqltable = "XCHANGE";
			// $formattedPrice = number_format($this->bookprice, 2, '.');
			// $formattedPrice = "100.20";
			$formattedPrice = $this->bookprice;
			$query = "INSERT INTO XCHANGE (STUDID, BOOKID, CONDID, BOOKPRICE, BOOKIMG, BOOKRES, BOOKDATE, BOOKSOLD) VALUES ('$this->StudID', '$this->bookid', '$this->condid', '$formattedPrice', '$this->bookimg', '$this->bookres', '$this->bookdate', '$this->booksold')";
			error_log($query);
			$result = $this->WriteDelDbase($sqltable, $query); 		/*Call 'WriteToDbase' from dbase.php */

			return $result;
		}

		//Delete a Student from the Database
		function deleteXchange($par){
			$sqltable = "XCHANGE";
			$query = "DELETE FROM XCHANGE WHERE STUDID = '$par'";
			return $this->WriteDelDbase($sqltable, $query);
		}

		//Update the Student Informtation in the database for a specific student.
		function updateXchange(){
			$sqltable = "XCHANGE";
			$query = "UPDATE";
			return $this->WriteDelDbase($sqltable, $query);
		}
		

	} /* End Class */
?>