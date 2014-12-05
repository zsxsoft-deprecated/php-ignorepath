<?php
ini_set('display_error', 1); error_reporting(E_ALL);
require('parser.php');
$parser = new PathParser('', './test.txt');

$array = array(
	"/just/1.jpg", 
	"/just/testing/dirA/",
	"/just/testing/dir3/",
	"/just/testing/dir1/",
	"/just/testing/dir1/1.html",
	"/just/testing/dir1/1.php",
	"/just/testing/dir1/123.jpg",
	"/just/testing/dir1/abc.jpg",
	"/just/testing/dir2/",
	"/just/testing/dir2/exclude.html",
	"/just/testing/dir2/1.html",

);
for ($i = 0; $i < count($array); $i++) {
	echo $array[$i] . "   -  " . ($parser->checkPath($array[$i]) ? "IN LIST" : "") . " <br/>\n";
	echo "\n\n";
}
