<?php
$db_connection = mysql_connect("localhost", "cs143", "");
   if(!$db_connection){
   $errmsg = mysql_error($db_connection);
   print "Connection failed: $errmsg <br />";
   exit(1);
}
mysql_select_db("TEST", $db_connection);
$query= $_GET["query"];

$result = mysql_query($query, $db_connection);
$num_rows = mysql_num_rows($result);
$print_array = mysql_fetch_assoc($result);

if ($query) {
   print "<br> Results from MySQL: <br />";
}

if ($_GET["submit"] && !sizeof($print_array)) {
   print "No answer found.";
}

else {
   print '<table border="1"><tr>';
   foreach(array_keys($print_array) as $col) {
   print '<td>' . $col . '</td>'; }
   
   //print "<br />";
   print '</tr>';

   mysql_data_seek($result, 0);
   while($print_array = mysql_fetch_assoc($result)){
   print '<tr>';
   foreach($print_array as $row) {
   print '<td>' . $row . '</td>'; 
   }
   print '</tr>';
}
print '</table>';
}

mysql_free_result($result);
mysql_close($db_connection);

?>