<?php

include('php/book.php');

class BookTest extends PHPUnit_Framework_TestCase
{

	/**
 	* @covers BOOK::getBookName
 	*/
 	public function testGetBookName()
 	{
 		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
 		$this->assertEquals('Harry Potter', $thisBook->getBookName());
 		$this->assertNotEquals('Parry Hotter', $thisBook->getBookName());
 	}

 	/**
 	* @covers BOOK::getBookISBN
 	*/
 	public function testGetBookISBN()
 	{
 		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
 		$this->assertEquals('1234567890', $thisBook->getBookISBN());
 		$this->assertNotEquals('1122334455', $thisBook->getBookISBN());
 	}

 	/**
 	* @covers BOOK::getBookAuthor
 	*/
 	public function testGetBookAuthor()
 	{
 		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
 		$this->assertEquals('J. K. Rowling', $thisBook->getBookAuthor());
 		$this->assertNotEquals('Harry Smith', $thisBook->getBookAuthor());
 	}

	/**
 	* @covers BOOK::getBookPublisher
 	*/
 	public function testGetBookPublisher()
 	{
 		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
 		$this->assertEquals('ACME Publishing', $thisBook->getBookPublisher());
 		$this->assertNotEquals('Judge Publishing', $thisBook->getBookPublisher());
 	} 	

 	/**
 	* @covers BOOK::getBookEdition
 	*/
 	public function testGetBookEdition()
 	{
 		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
 		$this->assertEquals('1', $thisBook->getBookEdition());
 		$this->assertNotEquals('2', $thisBook->getBookEdition());
 	} 

	public function testBookCreate()
	{
		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
		$thisBook->setBookName('Judge Dredd');
		$thisBook->setBookISBN('1122334455');
		$thisBook->setBookAuthor('Harry Smith');
		$thisBook->setBookPublisher('Judge Publishing');
		$thisBook->setBookEdition('2');

		$this->assertEquals('Judge Dredd', $thisBook->getBookName());
		$this->assertEquals('1122334455', $thisBook->getBookISBN());
		$this->assertEquals('Harry Smith', $thisBook->getBookAuthor());
		$this->assertEquals('Judge Publishing', $thisBook->getBookPublisher());
		$this->assertEquals('2', $thisBook->getBookEdition());


	}
}