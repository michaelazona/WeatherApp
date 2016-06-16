<?php

	require_once 'functions.php';

	class variousPHPUnitTests extends PHPUNIT_Framework_TestCase
	{
		//incase there were any alterations to the SQL statment - this will make sure the query is always the right one!
		public function testSqlStatementToAddEmail()
		{
			$sql = "INSERT INTO `emails` (`email`, `lastCity`, `lastZip`) VALUES ('donald@duck.com', 'Disney World', '32830')";
			$this->assertEquals(assembleSQLForAddingEmail("donald@duck.com", "Disney World", "32830"), $sql);
		}

		//checks to make sure database can still be connected to - incase someone messed with the credentials, dbname, etc.
		public function testDatabaseConnectionFunction()
		{
			$conn = connectToDatabase();

			if($conn)  { $this->assertTrue(TRUE) ;}
			else       { $this->assertTrue(FALSE);}

			$conn->close();
		}

		//checks to make sure google zip code api is still working as it should
		public function testGoogleZipCodeApiChecker()
		{
			$shouldBeTrue = validateZipWithCity("Mounds View", "55112");
			$this->assertTrue($shouldBeTrue == "TRUE");

			$shouldBeTrue = validateZipWithCity("Bloomington", "55431");
			$this->assertTrue($shouldBeTrue == "TRUE");

			$shouldBeTrue = validateZipWithCity("Burnsville", "55337");
			$this->assertTrue($shouldBeTrue == "TRUE");
		}
	}
?>
