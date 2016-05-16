<?php

include_once('php/student.php');

class StudentDbaseTest extends PHPUnit_Extensions_Database_TestCase
{
    // only instantiate pdo once for test clean-up/fixture load
    protected $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    //public function __construct()
    //{
	//	$ds = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
	//	$ds->addTable('STUDENT');

    //}

    // IMPORTANT : overload getSetUpOperation and add "TRUE" parameter to CLEAN_INSERT()
    protected function getSetUpOperation() 
    {
        return PHPUnit_Extensions_Database_Operation_Factory::CLEAN_INSERT(TRUE);
    }

    public function getConnection()
    {
        //if (null === $this->pdo) {
        //    $this->pdo = new PDO('mysql::memory:');
        //    $this->pdo->exec('CREATE TABLE STUDENT (STUDID INT, UUID CHAR(128), FIRSTNAME VARCHAR(20),				
	//    LASTNAME VARCHAR(20), EMAIL VARCHAR(40), PHONE VARCHAR(10), PASSWORD CHAR(60), PRIMARY KEY (STUDID))');
        //}
        //return $this->createDefaultDBConnection($this->pdo, ':memory:');
        
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->createMySQLXMLDataSet('file.xml');
    }

    
    //Test adding student to Database
	public function testAddStudent()
    {
        $this->assertEquals(0, $this->getConnection()->getRowCount('STUDENT'));

        $thisStudent = new Student('1234567', 'Danielle', 'Walker', 'danielle@bliss.net.au', '123456789', 'password');
        $thisStudent->addStudent();

        $this->assertEquals(1, $this->getConnection()->getRowCount('STUDENT'));

    }

    //Test deleting Student from Database
    public function testDeleteStudent()
    {
    	$thisStudent = new Student('1234567', 'Danielle', 'Walker', 'danielle@bliss.net.au', '123456789', 'password');
        $thisStudent->addStudent();
        $this->assertEquals(1, $this->getConnection()->getRowCount('STUDENT'));
    	
    	$thisStudent->deleteStudent('1234567');
    	$this->assertEquals(0, $this->getConnection()->getRowCount('STUDENT'));
    }
	
	//Testing looking for a Student in the Database
	public function testFindStudent()
	{
		$thisStudent = new Student('1234567', 'Danielle', 'Walker', 'danielle@bliss.net.au', '123456789', 'password');
		$thisStudent->addStudent();
		$thisStudent->findStudent('1234567', 'password');
		$this->assertEquals(1, $this->getConnection()->getRowCount('STUDENT'));
	}

	

}
