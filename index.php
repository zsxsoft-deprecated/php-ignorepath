<?php
ini_set('display_error', 1); error_reporting(E_ALL);
require('parser.php');
$parser = new PathParser('', './test.txt');

$array = array("/zb_system/", "/zb_users/cache/1.html", "/zb_users/cache/111.jpg", "/zb_users/cache/fuckme/", "/zb_users/cache/index.html", "/zb_users/plugins");
for ($i = 0; $i < count($array); $i++) {
	echo $array[$i] . "   -  " . ($parser->checkPath($array[$i]) ? "IN LIST" : "") . " <br/>\n";
	echo "\n\n";
}
