/* Student Class for The Book Exchaange
   Last Modified Date: 23/4/2016
   version: 1.0
		1.0 - Initall Student Class creation */
		
 <?php
	class Student {

	/* Class variables */
	var $StudID;
	var $fname;
	var $lname;
	var $email;
	var $phone;
	var $password;

	/* Class Constructor */
	function _construct ($studentID, $firstname, $surname, $studemail, $studphone, $studpass)
	{
		$this->StudID = $studentID;
		$this->fname = $firstname;
		$this->lname = $surname;
		$this->email = $studemail;
		$this->phone = $studphone;
		$this->password = $studpass;
	}

	/* Class Destructor */
	function _destruct(){

	}
	
	/* Class functions */
	function getStudentID(){
		return $this->StudID;
	}

	function getFirstName(){
		return $this->fname;
	}

	function getLastName(){
		return $this->lname;
	}

	function getEmail(){
		return $this->email;
	}

	function getPhone($par){
		return $this->phone;
	}

	function getPassword(){
		return $this->password;
	}

	}
?>