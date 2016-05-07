<?php

include('php/student.php');

class StudentTest extends PHPUnit_Framework_TestCase
{
	public function testStudentCreate()
	{
		$thisStudent = new Student('1060325', 'Danielle', 'Walker', 'danielle@swin.edu.au', '123456789', 'password');

		// Assert Eqauls Tests
        $this->assertEquals(1060325, $thisStudent->getStudentID());
        $this->assertEquals('Danielle', $thisStudent->getFirstName());
        $this->assertEquals('password', $thisStudent->getPassword());

        // Assert Not Equals Tests
        $this->assertNotEquals(1160325, $thisStudent->getStudentID());
        $this->assertNotEquals('Fred', $thisStudent->getFirstName());
        $this->assertNotEquals('Smith', $thisStudent->getLastName());

	}
}

?>