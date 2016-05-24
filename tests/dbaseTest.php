<?php

include('php/student.php');

class dbaseTest extends PHPUnit_Extensions_Database_TestCase
{

	// only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;


    public function __construct()
    {
		$ds = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());

    }


	final public function getConnection()
    {
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


    }
	


}