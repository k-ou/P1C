
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
          <li><a href="./comment.php">Add Movie Review</a></li>
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
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--CONTENT-->
<div class="col-md-3 sidebar"></div>

<!--MIDSECTION-->
<div class="col-md-6 midsection">

<!--START ACTOR / ACTRESS INFO-->
<div class="actorInfo tab-content">

  <h1>Actor / Actress Info</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Select an actor/actress from the list below to see his or her information and see
  the movies that they have acted in.</p>

  <?php 
  $db_connection = mysql_connect("localhost", "cs143", "");
  if (!$db_connection) {
    $errmsg = mysql_error($db_connection);
    print "Connection failed: $errmsg <br />";
    exit(1);
  }
  mysql_select_db("CS143", $db_connection);

  echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' id='actorForm'>";

  // DROPDOWN LIST OF ACTORS/ACTRESSES
  echo "Actor/Actress:<br>";
  $query = "SELECT first, last, id FROM Actor;";
  $actResult =  mysql_query($query);
  echo "<select form='actorForm' name='actor_list'>";
  echo "<option value=''>Select One</option>"; 
  if (!$actResult) {
    print "Addition failed. <br>";
    exit(1);
  }
  while ($row = mysql_fetch_array($actResult)) {
    print "<option value='" . $row['id'] . "'>" . $row['first'] . " " . $row['last'] . "</option>";  
  }
  echo "</select>";
  echo "<br><br>";
  echo "<input type='submit' name='submit' value='Submit'>";

  echo "</form>";

// php only runs if submit button is pressed
if (isset($_GET["submit"])) {

$aid = $_GET['actor_list'];

//using aid find actor info
$aInfo = "SELECT first, last, sex, dob, dod FROM Actor WHERE id='" . $aid . "';";
$a_result = mysql_query($aInfo, $db_connection);
print "<br> <h4>Actor/Actress Information: </h4>";


while ($p_act = mysql_fetch_assoc($a_result)) {
	foreach ($p_act as $type => $row) {
    if ($type == 'first') {
      print "Name: ";
    }
    if ($type == 'sex') {
      print "Sex: ";
    }
    if ($type == 'dob') {
      print "Date of birth: ";
    }
    if ($type == 'dod') {
      print "Date of death: ";
    }
    if ($row == "") {
      print "N/A";
    }
    else print $row . "\t";
    if ($type != 'first') {
      print "<br>";
    }
  }
}

//find mids using aid
$find_mid = "SELECT mid FROM MovieActor WHERE aid='" . $aid . "';";

$find_titles = "SELECT id, title, year FROM Movie WHERE ";

$mid_result = mysql_query($find_mid, $db_connection);
if(empty($mid_result)){
	print "No mids found. <br>";
	exit(1);
}
// complete query
mysql_data_seek($mid_result, 1);
$num_rows = mysql_num_rows($mid_result);
while($mid = mysql_fetch_assoc($mid_result)){
  foreach ($mid as $row) {
    $find_titles .= "id='" . $row . "'";
    $num_rows = $num_rows - 1;
  }
	if($num_rows > 1)
		$find_titles .= " OR ";
}
print "<br>";
//print $find_titles . "<br>";

// find titles
$titles_result = mysql_query($find_titles, $db_connection);

print "<h4>Movies acted in: </h4>";
if (empty($titles_result)) {
  print "No movie titles found. <br>";
}

while($titles = mysql_fetch_assoc($titles_result)){
  foreach($titles as $type => $row){
    if ($type == 'id') {
      print "<a href = './movieInfo.php?movie=" . $row . "&submit=Submit'>";
      continue;
    } else if ($type == 'title') {
      print $row . "</a>";
    }
    else if ($type == 'year') {
      print " (" . $row . ")";
    }
  }
	print "<br>";
}

mysql_free_result($id_result);
mysql_free_result($titles_result);
mysql_free_result($mid_result);
mysql_free_result($actResult);
mysql_free_result($a_result);
}
mysql_close($db_connection);
?>

</div>
<!--END ACTOR / ACTRESS INFO-->

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
