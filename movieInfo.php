
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

.movieInfo {
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

<!--START MOVIE INFO-->
<div class="movieInfo">

  <h1>Movie Info</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Select a movie from the list below to show participating actors and/or actresses,
  average score based on user ratings, and user comments.</p>

  <?php 
$db_connection = mysql_connect("localhost", "cs143", "");
if(!$db_connection){
   $errmsg = mysql_error($db_connection);
   print "Connection failed: $errmsg <br />";
   exit(1);
}
mysql_select_db("TEST", $db_connection);

/////////////////////////////////////////

echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' id='movDirRelForm'>";

// DROPDOWN LIST OF MOVIES
echo "Movie:<br>";
$query = "SELECT title, id FROM Movie;";
$movResult =  mysql_query($query);
echo "<select form='movDirRelForm' name='movie'>";
echo "<option value=''>Select One</option>"; 
if (!$movResult) {
    print "Addition failed. <br>";
    exit(1);
}
while ($row = mysql_fetch_array($movResult)) {
  print "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";  
}
echo "</select>";

echo "<br><br>";
echo "<input type='submit' name='submit' value='Submit'>";

echo "</form>";

/////////////////////////////////

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $movie = $_GET["movie"];
}

//using aid find actor info
$movInfo = "SELECT title, year, rating, company FROM Movie WHERE id='" . $movie . "';";
$mov_result = mysql_query($movInfo, $db_connection);
print "<br> <h4>Movie Information: </h4>";


while ($p_mov = mysql_fetch_assoc($mov_result)) {
  foreach ($p_mov as $type => $row) {
    if ($type == 'title') {
      print "Title: ";
    }
    if ($type == 'year') {
      print " (" . $row . ") <br>";
      continue;
    }
    if ($type == 'rating') {
      print "MPAA Rating: ";
    }
    if ($type == 'company') {
      print "Producer: ";
    }
    if ($row == "") {
      print "N/A";
    }
    else print $row;
    if ($type != 'title') {
      print "<br>";
    } else print " ";
  }
}

//find mids using aid
$find_aid = "SELECT aid FROM MovieActor WHERE mid='" . $movie . "';";
$find_act = "SELECT first, last FROM Actor WHERE ";

$aid_result = mysql_query($find_aid, $db_connection);
if(empty($aid_result)){
  print "No aids found. <br>";
  exit(1);
}
mysql_data_seek($aid_result, 1);
$num_rows = mysql_num_rows($aid_result);
while($actor = mysql_fetch_assoc($aid_result)){
  foreach($actor as $row){
    $find_act .= "id='" . $row . "'";
    $num_rows = $num_rows - 1;
  }
  if($num_rows > 1)
    $find_act .= " OR ";
}
print "<br>";
//print $find_titles . "<br>";

$act_result = mysql_query($find_act, $db_connection);
if (empty($act_result)) {
  print "No actors or actresses found. <br>";
  exit(1);
}

print "<h4>Actors and actresses in this movie: </h4>";

while($actor_list = mysql_fetch_assoc($act_result)){
  foreach($actor_list as $type => $row){
    if ($type == 'first') {
      print $row . " ";
      continue;
    }
    print $row;
  }
  print "<br>";
}

mysql_free_result($mov_result);
mysql_free_result($movResult);
mysql_free_result($dirResult);
mysql_free_result($result);
mysql_free_result($mid);
mysql_free_result($did);
mysql_close($db_connection);
?>

</div>
<!--END MOVIE INFO-->

</div>

<!--END MIDSECTION-->

<div class="col-md-3 sidebar"></div>

<!--END CONTENT-->

</body>
</html>