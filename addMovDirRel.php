
<?php 
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
   $errmsg = mysql_error($db_connection);
   print "Connection failed: $errmsg <br />";
   exit(1);
}
mysql_select_db("TEST", $db_connection);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $movie = $_GET["movie"];
   $dirLast = $_GET["dirLast"];
   $dirFirst = $_GET["dirFirst"];
}

<!--May be wrong.-->
$mid = mysql_query("SELECT id FROM Movie WHERE Movie.title='$movie'", $db_connection);
$did = mysql_query("SELECT id FROM Director WHERE Director.last='$dirLast' AND Director.first='$dirFirst'", $db_connection);
$query = "INSERT INTO MovieActor VALUES ('$mid', '$did')";
$result = mysql_query($query, $db_connection);

mysql_free_result($result);
mysql_free_result($mid);
mysql_free_result($did);
mysql_close($db_connection);
?>