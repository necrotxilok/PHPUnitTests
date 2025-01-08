<?php

/**
 * TestCase
 */
class TestCase
{

	/**
	 * Fail Flag for all TestCases
	 * @var bool
	 */
	public static bool $allTestsFailed = false;
	
	/**
	 * Fail Flag for the current TestCase
	 * @var bool
	 */
	public bool $testFailed = false;
	
	/**
	 * The TestCase Description
	 * @var string
	 */
	public string $description = '';


	// ----------------------------------------------------------

	/**
	 * Constructor
	 */
	public function __construct($description = '') {
		$this->description = $description;
	}

	/**
	 * Logs a message
	 * @param string $msg
	 */
	public function log($msg) {
		echo $msg;
	}

	/**
	 * Logs a new line message
	 */
	public function l($msg = "") {
		$this->log($msg . "\n");
	}

	/**
	 * Shows OK
	 */
	public function ok() {
		$this->l("OK");
	}

	/**
	 * Shows ERROR and mark TestCase as Failed 
	 */
	public function error() {
		$this->l("ERROR");
		$this->testFailed = true;
		static::$allTestsFailed = true;
	}

	/**
	 * Asserts Condition when running the Test
	 */
	public function assert($condition) {
		if ($condition) {
			$this->ok();
		} else {
			$this->error();
		}
	}

	// ----------------------------------------------------------

	/**
	 * Runs the TestCase Code written in $testFn
	 */
	public function run($testFn) {
		$this->start();
		if (!is_callable($testFn)) {
			$this->error();
			return;
		}
		try {
			call_user_func($testFn, $this);
		} catch(Exception $e) {
			$this->error();
			throw new Exception($e->getMessage());
		}
		$this->finish();
	}

	/**
	 * Checks All TestCases Results
	 */
	public function checkAll() {
		$this->start();
		if (static::$allTestsFailed) {
			$this->l("ERROR");
		} else {
			$this->l("OK");
		}
		$this->l();
	}

	// ----------------------------------------------------------

	/**
	 * Shows current TestCase Description
	 */
	protected function start() {
		$this->l();
		$this->l($this->description);
		$this->l("---------------------------------");
	}

	/**
	 * Shows current TestCase Result
	 */
	protected function finish() {
		$this->l("---------------------------------");
		if ($this->testFailed) {
			$this->l("ERROR");
		} else {
			$this->l("OK");
		}
		$this->l();
	}

}
