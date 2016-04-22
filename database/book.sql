/* Database Script for The Book Exchaange
   Date: 21/4/2016
   version: 1.0   */

CREATE DATABASE IF NOT EXISTS BOOKXCHANGE;
USE BOOKXCHANGE;

DROP TABLE IF EXISTS XCHANGE, BOOK, STUDENT;

CREATE TABLE STUDENT (
	STUDID INT NOT NULL,						/* Swinburne Student Id No */
	FIRSTNAME VARCHAR(20) NOT NULL,				/* Student First Name */
	LASTNAME VARCHAR(20) NOT NULL,				/* Student Last/surname */
	EMAIL VARCHAR(40) NOT NULL,					/* Email address - must end with "swin.edu.au" */
	PHONE VARCHAR(10),							/* Student Phone Number */
	PASSWORD VARCHAR(60) NOT NULL,				/* Password used - hashed/salted */
	PRIMARY KEY (STUDID)
);

CREATE TABLE BOOK (
	BOOKID INT NOT NULL AUTO_INCREMENT,
	BOOKNAME VARCHAR(30) NOT NULL,				/* Book Name or title */
	BOOKISBN VARCHAR(13) NOT NULL,				/* Book ISBN Number */
	BOOKAUTHOR VARCHAR(30) NOT NULL,        	/* Book Author(s) */
	BOOKPUB VARCHAR (30),						/* Book Publisher */
	BOOKEDIT INT,								/* Book Edition */
	PRIMARY KEY (BOOKID)
);

ALTER TABLE BOOK AUTO_INCREMENT=1000;			/* Auto Incermental with begin at No: 1000 */

CREATE TABLE XCHANGE (
	XCID MEDIUMINT NOT NULL AUTO_INCREMENT,		/* ID of the Xchange to occur */
	STUDID INT,									/* Student ID of Book Seller */
	BOOKID INT,									/* Book ID of Book being Sold */
	BOOKIMG MEDIUMBLOB,							/* Reserved for Image of Book */
	BOOKRES INT,								/* Student ID of Book Buyer */
	BOOKDATE DATE,								/* Date book sold */
	BOOKSOLD TINYINT(1),						/* did the book actually get sold? 0=NO 1=YES */
	PRIMARY KEY (XCID),
	FOREIGN KEY (STUDID) REFERENCES STUDENT(STUDID),
	FOREIGN KEY (BOOKID) REFERENCES BOOK (BOOKID)
);
