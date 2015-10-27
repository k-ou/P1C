<?php
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
	$errmsg = mysql_error($db_connection);
	print "Connection failed: $errmsg <br />";
	exit(1);
}
mysql_select_db("TEST", $db_connection);

$id = "";
$title = "";
$year = "";
$rating = "";
$company = "";
$genre = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $title = $_GET["title"];
   $year = $_GET["year"];
   $rating = $_GET["rating"];
   $company = $_GET["company"];
   $genre = $_GET["genre"];
}

$updateID = mysql_query("UPDATE MaxMovieID SET id=id+1", $db_connection);
$query = "INSERT INTO Movie VALUES ('$updateID', '$title', '$year', '$rating', '$company')";
$result = mysql_query($query, $db_connection);

if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}
else {
   print "You've successfully added <br />" . $firstName . " " . $lastName;
}

mysql_free_result($result);
mysql_close($db_connection);

?>