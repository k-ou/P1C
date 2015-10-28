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
height:100%;
-webkit-box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
padding-top: -50px;
}

.addActorDir {
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
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
      <a class="navbar-brand" href="./query.php">
        <img alt="IMDB" src="http://www.lanfranchismemorialdiscotheque.com/wp-content/themes/lanfran/images/imdb_logo.png">
      </a>
   </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
   <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <!--ADD NEW dropdown-->
      <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add New Content <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./addActorDir.php">Add Actor/Director</a></li>
          <li><a href="./addMovie.php">Add Movie Information</a></li>
          <li><a href="./addMovActRel.php">Add Movie/Actor Relation</a></li>
          <li><a href="./addMovDirRel.php">Add Movie/Director Relation</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
      <!--end ADD NEW dropdown-->
      <!--start BROWSE dropdown-->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./actorInfo.php">All Actors/Actresses</a></li>
          <li><a href="./movieInfo.php">All Movies</a></li>
        </ul>
      </li>
  <!--end dropdown-->
      </ul>
      <!--IMPLEMENT SEARCH-->
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./movieDBQuery.php">Enter Query</a></li>
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

<!--ADD ACTOR / DIR-->
<div class="addActorDir">

  <h1>Add Actor / Director</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Add an actor/actress or a director.</p>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">
  <input type="radio" name="position" value="Actor" checked>Actor/Actress
  <input type="radio" name="position" value="Director">Director
  <br>
  First name:<br>
  <input type="text" name="firstName">
  <br>
  Last name:<br>
  <input type="text" name="lastName">
  <br>
  Sex:
  <input type="radio" name="sex" value="female" checked>Female
  <input type="radio" name="sex" value="male">Male
  <br>
  Date of Birth (yyyy-mm-dd):<br>
  <input type="text" name="dob">
  <br>
  Date of Death (yyyy-mm-dd or leave blank):<br>
  <input type="text" name="dod">
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>

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
print "<br>lastName: " . $lastName . "<br>sex: " . $sex;
print "<br>dob: " . $dob . "<br>dod: " . $dod;
print "<br>";
//check that firstName + lastName contain only letters + ' + -
//check dob and dod are correct format yyyy-mm-dd

$numpattern = '([0-9]+)';
$cpattern = '([?_<>,~$%#@]+)';

preg_match($numpattern, $firstName, $nfmatches);
preg_match($cpattern, $firstName, $cfmatches);
if(!empty($nfmatches) || !empty($cfmatches)) 
{
	print "Invalid expression for first name. Please try again.";
	exit(1);
}
preg_match($numpattern, $lastName, $nlmatches);
preg_match($cpattern, $lastName, $clmatches);

if(!empty($nlmatches) || !empty($clmatches))
{
	print "Invalid expression for last name. Please try again.";
	exit(1);
}

if($firstName == "" || $lastName == "")
{
	print "You must provide a first and last name.";
	exit(1);
}

//check if dod > dob if dod != NULL

//check if that person is already in database using 
//firstName, lastName, sex, and dob
$query_check = "SELECT COUNT(*) FROM ".mysql_real_escape_string($position)." 
WHERE last='".mysql_real_escape_string($lastName)."' AND
first='".mysql_real_escape_string($firstName)."' AND
dob='".mysql_real_escape_string($dob)."';";

$check_results = mysql_query($query_check, $db_connection);
while($print_check = mysql_fetch_assoc($check_results)){
foreach($print_check as $row)
	if($row != 0)
	{
	 print "This person is already in our database.";
	 exit(1);
	}
}


mysql_free_result($check_results);

$updateID = mysql_query("UPDATE MaxPersonID SET id=id+1", $db_connection);

$query = "INSERT INTO ".mysql_real_escape_string($position)." 
VALUES('".mysql_real_escape_string($updateID)."', 
'".mysql_real_escape_string($firstName)."',
'".mysql_real_escape_string($lastName)."',
'".mysql_real_escape_string($sex)."',
'".mysql_real_escape_string($dob)."',
'".mysql_real_escape_string($dod)."');";

$result = mysql_query($query, $db_connection);

if ($_GET["submit"]) {
   if (!$result) {
   print "Insertion failed. <br>";
   exit(1);
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

</div>

<!--END MIDSECTION-->

<div class="col-md-3 sidebar"></div>

<!--END CONTENT-->

</body>
</html>
