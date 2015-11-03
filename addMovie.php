
<!DOCTYPE html>
<html>

<head>
<style>

html, body {
  height: 100%;
}

.sidebar {
  background-color: #C1C1C1;
  height: auto;
}

.midsection {
  height: auto;
  -webkit-box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
  -moz-box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
  box-shadow: 0px 0px 49px 2px rgba(0,0,0,0.75);
  padding-top: 50px;
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}

.tab-content {
  padding-top: 10px;
  padding-bottom: 150px;
  padding-left: 35px;
  padding-right: 35px;
}

.footer {
  padding-top: 50px;
  padding-bottom: 50px;
  text-align: center;
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

<nav class="navbar navbar-inverse navbar-fixed-top">
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
      <form action="./search.php" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text"  name="search" class="form-control" placeholder="Search">
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
<div class="col-md-6 midsection">

  <!--ADD MOVIE-->
<div class="addMovie tab-content">

  <h1>Add Movie</h1>
  <p>Add New Movie:</p>

<!--<form action="<?php $_SERVER['PHP_SELF'];?>" method="get">-->
<form action="./addMovie.php" method="GET">
  Title:<br>
  <input type="text" name="title">
  <br>
  Company:<br>
  <input type="text" name="company"><br>
  Year:<br>
  <input type="text" name="year"><br>
  MPAA Rating :
  <select name="mpaarating">
    <option value="G">G</option>
    <option value="PG">PG</option>
    <option value="PG-13">PG-13</option>
    <option value="NC-17">NC-17</option>
    <option value="R">R</option>
    <option value="surrendere">surrendere</option>
  </select><br/>
    Genre:<br>
  <input type="checkbox" name="action"> Action<br>
    <input type="checkbox" name="adult"> Adult<br>
    <input type="checkbox" name="adventure"> Adventure<br>
    <input type="checkbox" name="animation"> Animation<br>
    <input type="checkbox" name="comedy"> Comedy<br>
    <input type="checkbox" name="crime"> Crime<br>
    <input type="checkbox" name="documentary"> Documentary<br>
    <input type="checkbox" name="family"> Family<br>
    <input type="checkbox" name="fantasy"> Fantasy<br>
    <input type="checkbox" name="horror"> Horror<br>
    <input type="checkbox" name="musical"> Musical<br>
    <input type="checkbox" name="myster"> Mystery<br>
    <input type="checkbox" name="romance"> Romance<br>
    <input type="checkbox" name="sci-fi"> Sci-Fi<br>
    <input type="checkbox" name="short"> Short<br>
    <input type="checkbox" name="thriller"> Thriller<br>
    <input type="checkbox" name="war"> War<br>
    <input type="checkbox" name="western"> Western<br>
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

// php only runs if submit button is pressed
if (isset($_GET["submit"])){


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

/*if($year < 1900 || $year > 2015)
{
  print "Invalid year. Please try again.";
  exit(1);
}*/

$getUpdate = mysql_query("UPDATE MaxMovieID SET id=id+1", $db_connection);
if(!$getUpdate){
	print "Update failed.";
	exit(1);
}
$getNewID = mysql_query("SELECT id FROM MaxMovieID", $db_connection);
if(!$getNewID){
	print "Insertion failed.";
	exit(1);
}

while($id = mysql_fetch_assoc($getNewID)){
	foreach($id as $row)
	{ $updateID = $row;
}
}
mysql_free_result($getUpdate);


print "updateID: " . $updateID . "<br>";


$query = "INSERT INTO Movie VALUES ('".mysql_real_escape_string($updateID)."',
  '".mysql_real_escape_string($title)."',
  '".mysql_real_escape_string($year)."',
  '".mysql_real_escape_string($rating)."',
  '".mysql_real_escape_string($company)."');";

$result = mysql_query($query, $db_connection);

if ($_GET["submit"]){
	if(!$result){
	print "Insertion failed. <br>";
	exit(1);
}
	else{
	print "You've successfully added <br />" . $title;
}
}

}
mysql_free_result($result);

mysql_close($db_connection);

?>

</div>
<!--END ADD MOVIE-->

<hr>

<!--FOOTER-->
<div class="footer">
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br></p>
</div>
<!--END FOOTER-->

</div>
<!--END MIDSECTION-->

<div class="col-md-3 sidebar"></div>
<!--END CONTENT-->

</body>
</html>
