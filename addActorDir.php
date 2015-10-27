<?php
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
   $errmsg = mysql_error($db_connection);
   print "Connection failed: $errmsg <br />";
   exit(1);
}
mysql_select_db("TEST", $db_connection);

$position = "";
$firstName = "";
$lastName = "";
$sex = "";
$dob = "";
$dod = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $position = $_GET["position"];
   $firstName = $_GET["firstName"];
   $lastName = $_GET["lastName"];
   $sex = $_GET["sex"];
   $dob = $_GET["dob"];
   $dod = $_GET["dod"]; 
}

print "position: " . $position . "<br>firstName: " . $firstName;

$updateID = mysql_query("UPDATE MaxPersonID SET id=id+1", $db_connection);
$query = "INSERT INTO '$position' VALUES ('$updateID', '$firstName', '$lastName', '$sex', '$dob', '$dod')";
$result = mysql_query($query, $db_connection);

if ($_GET["submit"]) {
   if (!$result) {
   $message  = 'Invalid query: ' . mysql_error() . "\n";
   $message .= 'Whole query: ' . $query;
   die($message);
   }
   else {
   print "You've successfully added <br />" . $firstName . " " . $lastName;
   }
}

mysql_free_result($result);
mysql_close($db_connection);
?>