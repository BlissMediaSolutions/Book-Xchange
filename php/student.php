<?php
/* Student Class for The Book Exchaange
   Last Modified Date: 25/4/2016
   version: 1.1
		1.0 - Initall Student Class creation 
		1.1 - Adding db communication to write Student to db */
 
	class Student 
	{

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

		function addNewStudent($studentID, $firstname, $surname, $studemail, $studphone, $studpass)
		{
				//var $result;
			$query = "INSERT INTO STUDENT (STUDID, FIRSTNAME, LASTNAME, EMAIL, PHONE, PASSWORD) VALUES ('$studentID', '$firstname', '$surname', '$studemail', '$studphone', '$studpass')";
			$query = addDBComms($query);
			//setBookID($thisbookID);
		}

		function addDBComms($sqlquery)
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
				$studquery = "SELECT MAX(STUDID) FROM STUDENT";
				$newresult = mysqli_query($conn, $studquery);
				return mqsqli_fetch_row($newresult);
				 
				mysqli_free_result($newresult);
			}
			mysqli_close($conn);
		}

	} /* End Class */
?>