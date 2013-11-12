<?php
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class Test extends PHPUnit_Framework_TestCase {
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated Test::setUp()
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated Test::tearDown()
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	public function testMyMethods()
	{
		//The method 'returnTrue' should always give the same result (true)
		$this->assertTrue(returnTrue());
		//This method 'returnFalse' should always give the same result (false)
		$this->assertFalse(returnFalse());
		//yes, 5 is more than 4
		$this->assertEquals(true, greaterThan(4, 5));
		//no, 4 is less than 10
		$this->assertEquals(false, greaterThan(10, 4));
		
	}
	
	
}


function returnTrue()
{
	return true;
}

function returnFalse()
{
	return false;
}

function greaterThan($min, $value)
{
	return ($value > $min);
}
