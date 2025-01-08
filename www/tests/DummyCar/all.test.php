<?php

require_once "../../core/TestCase.php";

require_once "01.test.php";
require_once "02.test.php";

$test = new TestCase("ALL TESTS");
$test->checkAll();
