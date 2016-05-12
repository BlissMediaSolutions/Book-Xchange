<?php

include('php/student.php');

class StudentTest extends PHPUnit_Framework_TestCase
{
	public function testStudentCreate()
	{
	        //Testing our Hack version of Overloaded Constructors, with 2 different constructors

                //Testing Basic Constructor with only 2 parameters
                $thatStudent = new Student('1060325', 'password');
                $this->assertEquals(1060325, $thatStudent->getStudentID());
                $this->assertEquals('password', $thatStudent->getPassword());

                $this->assertNotEquals(1160325, $thatStudent->getStudentID());
                $this->assertNotEquals('drowssap', $thatStudent->getPassword());

                $thatStudent->setPassword('NewPassword');
                $this->assertEquals('NewPassword', $thatStudent->getPassword());

                
                //Testing more advanced constructor with 6 parameters
                $thisStudent = new Student('1060325', 'Danielle', 'Walker', 'danielle@swin.edu.au', '123456789', 'password');
                $this->assertEquals(1060325, $thisStudent->getStudentID());
                $this->assertEquals('Danielle', $thisStudent->getFirstName());
                $this->assertEquals('Walker', $thisStudent->getLastName());
                $this->assertEquals('danielle@swin.edu.au', $thisStudent->getEmail());
                $this->assertEquals('123456789', $thisStudent->getPhone());
                $this->assertEquals('password', $thisStudent->getPassword());
               
                $this->assertNotEquals(1160325, $thisStudent->getStudentID());
                $this->assertNotEquals('Fred', $thisStudent->getFirstName());
                $this->assertNotEquals('Smith', $thisStudent->getLastName());
                $this->assertNotEquals('danielle@bliss.net.au', $thisStudent->getEmail());
                $this->assertNotEquals('987654321', $thisStudent->getPhone());
                $this->assertNotEquals('drowssap', $thisStudent->getPassword());

                $thisStudent->setFirstName('Fred');
                $thisStudent->setLastName('Smith');
                $thisStudent->setEmail('fred@bliss.net.au');
                $thisStudent->setPhone('987654321');
                $thisStudent->setPassword('drowssap');
                $this->assertEquals('Fred', $thisStudent->getFirstName());
                $this->assertEquals('Smith', $thisStudent->getLastName());
                $this->assertEquals('fred@bliss.net.au', $thisStudent->getEmail());
                $this->assertEquals('987654321', $thisStudent->getPhone());
                $this->asserEquals('drowssap', $thisStudent->getPassword());


	}
}

?>