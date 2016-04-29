<?php
/* Student Class for The Book Exchaange
   Last Modified Date: 28/4/2016
   version: 1.3
		1.0 - Initall Student Class creation 
		1.1 - Adding db communication to write Student to db 
		1.2 - Create Dbase class to handle all db query, modify student in accordance
		1.3 - Allow retrieval of a map/array representation of a student object.  */
 	//
include('dbase.php');
	
	class Student extends dbase
	{

		/* Class variables */
		private $StudID;
		private $fname;
		private $lname;
		private $email;
		private $phone;
		private $password;

		/* Class Constructor */
		public function __construct ($studentID, $firstname, $surname, $studemail, $studphone, $studpass)
		{
			$this->StudID = $studentID;
			$this->fname = $firstname;
			$this->lname = $surname;
			$this->email = $studemail;
			$this->phone = $studphone;
			$this->password = $studpass;
		}

		/* Class Destructor */
		function __destruct(){

		}
		
		/* Class set/get functions */
		function getStudentID(){
			return $this->StudID;
		}

		function setFirstName($par){
			$this->fname = $par;
		}

		function getFirstName(){
			return 'fn:' . '(' . $this->fname . ')';
		}

		function setLastName($par){
			$this->lname = $par;
		}

		function getLastName(){
			return $this->lname;
		}

		function setEmail($par){
			$this->email = $par;
		}

		function getEmail(){
			return $this->email;
		}

		function setPhone($par){
			$this->phone = $par;
		}

		function getPhone(){
			return $this->phone;
		}

		function setPassword($par){
			$this->password = $par;
		}

		function getPassword(){
			return $this->password;
		}

		function mapRepresentation(){
			return array( 
				'firstname' => $this->fname, 
				'surname' => $this->lname, 
				'email' => $this->email, 
				'studentID' => $this->StudID, 
				'telephone' => $this->phone, 
				'authenticated' => true 
			);
			// return array( 'firstname' => $this->getFirstName() );
		}

		function addStudent(){
			$sqltable = "STUDENT";
			$query = "INSERT INTO STUDENT (STUDID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ('$this->StudID', '$this->fname', '$this->lname', '$this->email', '$this->phone', '$this->password')";
			WriteToDbase($sqltable, $query); 		/*Call 'WriteToDbase' from dbase.php */
		}

		function deleteStudent(){
			$sqltable = "STUDENT";
			$query = "DELETE FROM STUDENT WHERE STUDID = '1060325'";
			deleteFromDbase($sqltable, $query);
		}

		function updateStudent(){

		}

		

	} /* End Class */
?>