<?php
/* Database Class for The Book Exchaange
   Last Modified Date: 27/4/2016
   version: 1.0
		1.0 - Initall Database Class creation 
		 */
 
 	require ("settings.php");			//database connection info
	
	Function WritetoDbase()
		{
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

		Function deleteFromDbase($sqltable, $query)
		{

		}

		function SearchDbase()
		{}

	}
?>