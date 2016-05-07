<?php
/* Student Class for The Book Exchaange
   Last Modified Date: 06/05/2016
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
		private $uuid;
		private $password;
		private $authenticated;

		/* Class Constructor */
		public function __construct ()
		{
			$get_arguments       = func_get_args();
	        $number_of_arguments = func_num_args();

	        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
	            call_user_func_array(array($this, $method_name), $get_arguments);
	        }
		}

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

		public function __construct2($studentEmail, $password) {
			$sqltable = "STUDENT";
			$query = "SELECT * FROM STUDENT WHERE email='$studentEmail' AND password='$password'";
			$values = $this->readFromDbase($sqltable, $query);

			if ($values !== false && $values[0] != null) {
				$student = $values[0];
				$this->StudID = $student['STUDID'];
				$this->fname = $student['FIRSTNAME'];
				$this->lname = $student['LASTNAME'];
				$this->email = $student['EMAIL'];
				$this->phone = $student['PHONE'];
				$this->uuid = $student['UUID'];
				$this->authenticated = true;
			}else{
				$this->authenticated = false;
			}
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

		function getAuthenticated(){
			return $this->authenticated;
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

		//Add new Student to Database
		function addStudent(){
			$sqltable = "STUDENT";
			$query = "INSERT INTO STUDENT (STUDID, UUID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ('$this->StudID', '$uniqueUID x', '$this->fname', '$this->lname', '$this->email', '$this->phone', '$this->password')";
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

		

	} /* End Class */
?>