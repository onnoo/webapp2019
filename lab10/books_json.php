<?php
$BOOKS_FILE = "books.txt";

function filter_chars($str) {
	return preg_replace("/[^A-Za-z0-9_]*/", "", $str);
}

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$category = "";
$delay = 0;

if (isset($_REQUEST["category"])) {
	$category = filter_chars($_REQUEST["category"]);
}
if (isset($_REQUEST["delay"])) {
	$delay = max(0, min(60, (int) filter_chars($_REQUEST["delay"])));
}

if ($delay > 0) {
	sleep($delay);
}

if (!file_exists($BOOKS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $BOOKS_FILE");
}

header("Content-type: application/json");

print "{\n  \"books\": [\n";

$lines = file($BOOKS_FILE);
$books = array();
for ($i = 0; $i < count($lines); $i++) {
  $book_info = explode("|", trim($lines[$i]));
  if ($book_info[2] == $category) {
    // print("    {\"category\": \"{$category}\", \"year\": {$year}, \"price\": {$price},\n");
    // print("     \"title\": \"{$title}\", \"author\": \"{$author}\"},\n");
    $books[] = $book_info;
  }
}

for ($i = 0; $i < count($books); $i++) {
  list($title, $author, $category_, $year, $price) = $books[$i];
  print("    {\"category\": \"{$category_}\", \"title\": \"{$title}\", \"author\": \"{$author}\", \"year\": {$year}, \"price\": {$price}}");
  if ($i != count($books) - 1) {
    print(",");
  }
  print("\n");
}

print "  ]\n}\n";

?>
