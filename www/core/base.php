<?php

require_once "functions.php";

$scriptDir = dirname($_SERVER["SCRIPT_FILENAME"]);
$testsDir = $scriptDir . '/tests';

$path = '/';
if (!empty($_GET['path'])) {
	$dirPath = normalizePath($_GET['path']);
	if (is_dir($testsDir.$dirPath)) {
		$path = $dirPath;
	}
}
$execPath = '';
if (!empty($_GET['exec'])) {
	$execPath = normalizePath($_GET['exec']);
	if (is_file($testsDir.$execPath) && str_ends_with($execPath, '.test.php')) {
		$path = $execPath;
	} else {
		$execPath = '';
	}
}
if ($path != '/') {
	$backPath = dirname($path);
}
if (!$execPath) {
	$current = $testsDir . $path;
	$list = getTestFiles($current);
	extract($list);
}
