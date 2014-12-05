<?php
ini_set('display_error', 1); error_reporting(E_ALL);
require('parser.php');
$parser = new PathParser('', './test.txt');

$start = microtime(true);
$array = array(
	"/just/1.jpg",                     // N
	"/just/testing/dirA/",             // Y
	"/just/testing/dir3/",             // N
	"/just/testing/dir1/",             // N
	"/just/testing/dir1/1.html",       // Y
	"/just/testing/dir1/1.php",        // N
	"/just/testing/dir1/123.jpg",      // N
	"/just/testing/dir1/abc.jpg",      // Y
	"/just/testing/dir2/",             // Y
	"/just/testing/dir2/exclude.html", // N
	"/just/testing/dir2/1.html",       // Y

);
for ($i = 0; $i < count($array); $i++) {
	echo $array[$i] . "   -  " . ($parser->checkPath($array[$i]) ? "Y" : "N") . " <br/>\n";
	echo "\n\n";
}
echo "\n";
var_dump(microtime(true) - $start);