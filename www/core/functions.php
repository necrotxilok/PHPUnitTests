<?php 

/**
 * Debug Functions
 */
function pr($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}
function prd($data)
{
	pr($data);
	die;
}

/**
 * Normalize Path
 */
function normalizePath($path, $relative = false) {
	if ($relative) {
		global $testsDir;
		$path = str_replace($testsDir, "", $path);
	}
	$root = ($path[0] === '/') ? '/' : '';

	$segments = explode('/', trim($path, '/'));
	$ret = array();
	foreach($segments as $segment){
		if ($segment == '.' || $segment == '..' || strlen($segment) === 0) {
			continue;
		}
		array_push($ret, $segment);
	}
	return $root . implode('/', $ret);
}

/**
 * Get a list of test files and folders in the given directory path
 */
function getTestFiles($dir) {
	$folders = array();
	$files = array();

	$paths = scandir($dir);
	foreach ($paths as $path) {
		if (str_starts_with($path, '.')) {
			continue;
		}
		$fullPath = $dir.'/'.$path;
		if (is_dir($fullPath)) {
			$check = getTestFiles($fullPath);
			if (!empty($check['files'])) {
				$folders[] = normalizePath($fullPath, true);
			}
		} else {
			if (!str_ends_with($path, '.test.php')) {
				continue;
			}
			$files[] = normalizePath($fullPath, true);
		}
	}

	return array(
		'folders' => $folders,
		'files' => $files,
	);
}

