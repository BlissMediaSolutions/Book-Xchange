<?php
/* Database Class for The Book Exchaange
Last Modified Date: 09/05/2016
version: 1.0
1.0 - Initall Database Class creation 
*/

include('settings.php');
abstract class dbase
{
    
    //Function to Write,delete or Amend a record in the Database
    Function WriteDelDbase($sqltable, $query)
    {
        require("settings.php");
        //return true;
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) 
        {
            echo "<p><font color='red'> Error Connecting to Database </font></p>";
            return false;
        } else 
        {
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            if (!$result) {
                return false;
            }
            return true;
        }
    }
    
    Function deleteFromDbase($sqltable, $query)
    {
        require("settings.php");
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            echo "<p><font color='red'> Error Connecting to Database </font></p>";
        } else 
        {
            $result = mysqli_query($conn, $query);
            if (!$result) 
            {
                echo "<p class=\"wrong\">Something is wrong with ", $query, "</p>";
            }
            echo "Record Deleted";
            mysqli_close($conn);
            
        }
        
        function SearchDbase()
        {
        }
        
    }

    // function used to Read data from the database, if a result is found its added to an Array which is returned to the caller.
	function readFromDbase($sqltable, $query)
	{
	    require("settings.php");
	    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	    if (!$conn) {
	        return false;
	    } else {
	        $result = mysqli_query($conn, $query);
	        mysqli_close($conn);
	        if (!$result) {
	            return false;
	        }

	        while($row = mysqli_fetch_assoc($result)) {
	            $myArray[] = $row;
		    }

	        return $myArray;
	    }
	    
	}
    
}
?>
