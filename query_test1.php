<!DOCTYPE html>
<html>

<head>
<style>

html, body {
height: 100%;
}

.sidebar {
background-color: #C1C1C1;
height: 100%;
}

.tab-content {
    box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2);
height: 100%;
}

h1 {
font-family: Garamond, Arial, serif;
}

</style>
</head>

<body>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">IMDB</a>
   </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <!--ADD NEW dropdown-->
      <li class="dropdown active">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add New Content <span class="caret"></span></a>
	    <ul class="dropdown-menu">
            <li role="presentation"><a href=".addActorDir" role="tab" data-toggle="tab">Add Actor/Director</a></li>
	    <li role="presentation"><a href=".addMovie" role="tab" data-toggle="tab">Add Movie Information</a></li>
            <li><a href="#">Add Movie/Actor Relation</a></li>
            <li><a href="#">Add Movie/Director Relation</a></li>
	    <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
	<!--end ADD NEW dropdown-->
        <li><a href="#">Browse</a></li>
	<!--dropdown-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
	<!--end dropdown-->
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--CONTENT-->

<div class="col-md-3 sidebar"></div>

<!--MIDSECTION-->

<div class="col-md-6 tab-content">

<!--MOVIE DB-->

<div class="movieDBQuery tab-pane active" role="tabpanel">

<h1>Movie Database Query</h1>
<p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
Type a query in the following box, please use correct SELECT statements. <br>
For example, type in SELECT * FROM Actor WHERE id=10; </p>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
<textarea rows="4" cols"50" name="query"></textarea>
<br>
<input type="submit" value="submit query">
</form>

<!--PHP-->

<?php
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
$errmsg = mysql_error($db_connection);
print "Connection failed: $errmsg <br />";
exit(1);
}
mysql_select_db("CS143", $db_connection);
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
     foreach(array_keys($print_array) as $col)
     { print '<td>' . $col . '</td>'; }

     //print "<br />";
     print '</tr>';

     mysql_data_seek($result, 0);
     while($print_array = mysql_fetch_assoc($result)){
     			print '<tr>';
			      foreach($print_array as $row)
			      			      {print '<td>' . $row . '</td>'; }
						      	     print '</tr>';  
							     }
							     print '</table>';
}

mysql_free_result($result);
mysql_close($db_connection);

?>

<!--END PHP-->

</div> 

<!--END MOVIE DB-->

<!--ADD ACTOR / DIR-->

<div class="addActorDir tab-pane" role="tabpanel">

<h1>Add Actor / Director</h1>
<p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
Add an actor/actress or a director.</p>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
  <input type="radio" name="position" value="Actor" checked>Actor/Actress
  <input type="radio" name="position" value="Director">Director
  <br>
  First name:<br>
  <input type="text" name="firstname">
  <br>
  Last name:<br>
  <input type="text" name="lastname">
  <br>
  Sex:
  <input type="radio" name="sex" value="female" checked>Female
  <input type="radio" name="sex" value="male">Male
  <br>
  Date of Birth:<br>
  <input type="text" name="dob">
  <br>
  Date of Death:<br>
  <input type="text" name="dod">
  <br><br>
  <input type="submit" value="Submit">
</form>

<?php
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
$errmsg = mysql_error($db_connection);
print "Connection failed: $errmsg <br />";
exit(1);
}
mysql_select_db("CS143", $db_connection);

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

$query = "INSERT INTO '$position' VALUES (0, '$firstName', '$lastName', '$sex', '$dob', '$dod')";
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

</div>

<!--END ADD ACTOR / DIR-->

<!--ADD MOVIE-->

<div class="addMovie tab-pane" role="tabpanel">

<h1>Add Movie</h1>
<p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
<p>Add New Movie:</p>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
  Title:<br>
  <input type="text" name="title">
  <br>
  Company:<br>
  <input type="text" name="company"><br>
    Year:<br>
  <input type="text" name="year"><br>
    Genre:<br>
  <input type="checkbox" name="action">Action<br>
    <input type="checkbox" name="adult">Adult<br>
    <input type="checkbox" name="adventure">Adventure<br>
    <input type="checkbox" name="animation">Animation<br>
    <input type="checkbox" name="comedy">Comedy<br>
    <input type="checkbox" name="crime">Crime<br>
    <input type="checkbox" name="documentary">Documentary<br>
    <input type="checkbox" name="family">Family<br>
    <input type="checkbox" name="fantasy">Fantasy<br>
    <input type="checkbox" name="horror">Horror<br>
    <input type="checkbox" name="musical">Musical<br>
    <input type="checkbox" name="myster">Mystery<br>
    <input type="checkbox" name="romance">Romance<br>
    <input type="checkbox" name="sci-fi">Sci-Fi<br>
    <input type="checkbox" name="short">Short<br>
    <input type="checkbox" name="thriller">Thriller<br>
    <input type="checkbox" name="war">War<br>
    <input type="checkbox" name="western">Western<br>
  <br><br>
  <input type="submit" value="Submit">
</form>

<!--PHP-->

<!--
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
$errmsg = mysql_error($db_connection);
print "Connection failed: $errmsg <br />";
exit(1);
}
mysql_select_db("CS143", $db_connection);

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

// TO-DO: need to figure out how to use "position" variable to
// select corect TABLE
// TO-DO: figure out how to generate id
$query = "INSERT INTO Movie VALUES ('$id', '$title', '$year', '$rating', '$company')";
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
-->

<!--END PHP-->

</div>

<!--END ADD MOVIE-->

</div>

<!--END MIDSECTION-->

<div class="col-md-3 sidebar"></div>

<!--END CONTENT-->

</body>
</html>
