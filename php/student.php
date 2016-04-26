<?php
/* Student Class for The Book Exchaange
   Last Modified Date: 26/4/2016
   version: 1.2
		1.0 - Initall Student Class creation 
		1.1 - Adding db communication to write Student to db 
		1.2 - Create Dbase class to handle all db query, modify student in accordance  */
 
	class Student 
	{

		require ("dbase.php")

		/* Class variables */
		private $StudID;
		private $fname;
		private $lname;
		private $email;
		private $phone;
		private $password;

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

		function addNewStudent($this->StudID, $this->fname, $this->lname, $this->email, $this->phone, $this->password)
		{
			
			$query = "INSERT INTO STUDENT (STUDID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ('$this->StudID', '$this->fname', '$this->lname', '$this->email', '$this->phone', '$this->password')";
			$sqltable = "STUDENT";
			WriteToDbase($sqltable, $query);
		}

		function addDBComms($sqlquery)
		{
			//require_once ("settings.php");//connection info 
			//$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
			//if (!$conn) 
			//{
		//		echo "<p><font color='red'> Error Connecting to Database </font></p>";
		//	} else 
		//	{
		//		$result = mysqli_query($conn, $sqlquery);
		//		if(!$result) 
		//	{
		//		echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";		//		
		//	} else 
		//	{
		//		$studquery = "SELECT MAX(STUDID) FROM STUDENT";
		//		$newresult = mysqli_query($conn, $studquery);
		//		return mqsqli_fetch_row($newresult);
		//		 
		//		mysqli_free_result($newresult);
		//	}
		//	mysqli_close($conn);
		}

	} /* End Class */
?>