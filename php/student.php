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
	
	class Student extends dbase
	{

		/* Class variables */
		private $StudID;
		private $fname;
		private $lname;
		private $email;
		private $phone;
		private $uuid;
		private $password;
		private $authenticated;
		private $status;
		private $sqlid;

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
		public function __construct6($studentID, $firstname, $surname, $studemail, $studphone, $studpass) {
			$this->StudID = $studentID;
			$this->fname = $firstname;
			$this->lname = $surname;
			$this->email = $studemail;
			$this->phone = $studphone;
			$this->password = $studpass;

			$uniqueUID = hash_hmac('sha512', $this->email, 'fooCoo-n4wo&ung_ee4kaekeXaesae');
			$this->uuid = $uniqueUID;
	    }

	    /* Overloaded Constructor */
		public function __construct2($studentID, $password) {
			//$sqltable = "STUDENT";
			//$query = "SELECT * FROM STUDENT WHERE email='$studentEmail' AND password='$password'";
			//$values = $this->readFromDbase($sqltable, $query);

			//if ($values !== false && $values[0] != null) {
			//	$student = $values[0];
			//	$this->StudID = $student['STUDID'];
				$this->StudID = $studentID;	
				$this->password = $password;
			//	$this->fname = $student['FIRSTNAME'];
			//	$this->lname = $student['LASTNAME'];
			//	$this->email = $student['EMAIL'];
			//	$this->phone = $student['PHONE'];
			//	$this->uuid = $student['UUID'];
			//	$this->authenticated = true;
			//}else{
			//	$this->authenticated = false;
			//}
	    }

	    /* Overloaded Constructor */
		public function __construct1($uuidArg) {
			$this->uuid = $uuidArg;
		}

		// public function __construct (){
		// }

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
			return $this->fname;
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

		function getAuthenticated(){
			return $this->authenticated;
		}

		function getStatus(){
			return $this->status;
		}

		function mapRepresentation(){
			return array( 
				'firstname' => $this->fname, 
				'surname' => $this->lname, 
				'email' => $this->email, 
				'studentID' => $this->StudID, 
				'telephone' => $this->phone, 
				'uuid' => $this->uuid,
				'authenticated' => true 
			);
		}

		//Add new Student to Database
		function addStudent(){
			$sqltable = "STUDENT";
			$query = "INSERT INTO STUDENT (STUDID, UUID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ('$this->StudID', '$this->uuid', '$this->fname', '$this->lname', '$this->email', '$this->phone', '$this->password')";
			$result = $this->WriteDelDbase($sqltable, $query); 		/*Call 'WriteToDbase' from dbase.php */
			$this->authenticated = $result;

			return $result;
		}

		//Delete a Student from the Database
		function deleteStudent($par){
			$sqltable = "STUDENT";
			$query = "DELETE FROM STUDENT WHERE STUDID = '$par'";
			return $this->WriteDelDbase($sqltable, $query);
		}

		//Update the Student Informtation in the database for a specific student.
		function updateStudent(){
			$sqltable = "STUDENT";
			$query = "UPDATE";
			return $this->WriteDelDbase($sqltable, $query);
		}

		//function to find or check a Student exists within the datatbase
		function findStudent($StudID, $password){
			$sqltable = "STUDENT";
			$query = "SELECT * FROM STUDENT WHERE STUDID='$StudID' AND PASSWORD='$password'";
			return $this->readFromDbase($sqltable, $query);
			//$values = $this->readFromDbase($sqltable, $query);

		}

		function lookupStudentFromUUID(){
			$sqltable = "STUDENT";
			error_log("Looking up student...");
			$query = "SELECT * FROM STUDENT WHERE UUID='$this->uuid'";
			// error_log($query);
			$result = $this->readFromDbase($sqltable, $query);
			if ($result !== false) {
				$firstResult = $result[0];
				$this->StudID = $firstResult['STUDID'];
				$this->uuid = $firstResult['UUID'];
				$this->fname = $firstResult['FIRSTNAME'];
				$this->lname = $firstResult['LASTNAME'];
				$this->email = $firstResult['EMAIL'];
				$this->phone = $firstResult['PHONE'];
				$this->password = $firstResult['PASSWORD'];
				return true;
			}
			return false;
		}
		

	} /* End Class */
?>