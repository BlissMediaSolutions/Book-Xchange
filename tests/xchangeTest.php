<?php

include('php/xchange.php');

class StudentTest extends PHPUnit_Framework_TestCase
{
	public function testXchangeCreate()
	{

		$thatXchange = new xchange('100056391','001', '3', '105.00', ' ', '1', '2016-04-23', '1');
		$this->assertEquals(100056391, $thatXchange->getStudentID());
		$this->assertEquals('001', $thatXchange->getBookID());
		$this->assertEquals('105.00', $thatXchange->getBookPrice());
		$this->assertEquals(' ', $thatXchange->getBookImage());
		$this->assertEquals('1', $thatXchange->getBookRes());
		$this->assertEquals('2016-04-23', $thatXchange->getBookDate());
		$this->assertEquals('1', $thatXchange->getBookSold());

		$this->assertNotEquals(10056391, $thatXchange->getStudentID());
		$this->assertNotEquals('002', $thatXchange->getBookID());
		$this->assertNotEquals('15.00', $thatXchange->getBookPrice());
		$this->assertNotEquals('  ', $thatXchange->getBookImage());
		$this->assertNotEquals('0', $thatXchange->getBookRes());
		$this->assertNotEquals('2016-4-23', $thatXchange->getBookDate());
		$this->assertNotEquals('0', $thatXchange->getBookSold());
	}
}
?>