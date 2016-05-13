<?php

include('php/book.php');

class BookTest extends PHPUnit_Framework_TestCase
{
	//Function to run Unit Tests on the Book Class
	public function testBookCreate()
	{
		$thisBook = new Book('Harry Potter', '1234567890', 'J. K. Rowling', 'ACME Publishing', '1');
		$this->assertEquals('Harry Potter', $thisBook->getBookName());
		$this->assertEquals('1234567890', $thisBook->getBookISBN());
		$this->assertEquals('J. K. Rowling', $thisBook->getBookAuthor());
		$this->assertEquals('ACME Publishing', $thisBook->getBookPublisher());
		$this->assertEquals('1', $thisBook->getBookEdition());

		$thisBook->setBookName('Judge Dredd');
		$thisBook->setBookISBN('1122334455');
		$thisBook->setBookAuthor('Harry Smith');
		$thisBook->setBookPublisher('Judge Publishing');
		$thisBook->setBookEdition('2');

		$this->assertNotEquals('Harry Potter', $thisBook->getBookName());
		$this->assertNotEquals('1234567890', $thisBook->getBookISBN());
		$this->assertNotEquals('J. K. Rowling', $thisBook->getBookAuthor());
		$this->assertNotEquals('ACME Publishing', $thisBook->getBookPublisher());
		$this->assertNotEquals('1', $thisBook->getBookEdition());

		$this->assertEquals('Judge Dredd', $thisBook->getBookName());
		$this->assertEquals('1122334455', $thisBook->getBookISBN());
		$this->assertEquals('Harry Smith', $thisBook->getBookAuthor());
		$this->assertEquals('Judge Publishing', $thisBook->getBookPublisher());
		$this->assertEquals('2', $thisBook->getBookEdition());


	}
}