
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

<!--MOVIE DB-->

<div class="movieDBQuery tab-content">

  <h1>Movie Database Query</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Type a query in the following box, please use correct SELECT statements. <br>
  For example, type in SELECT * FROM Actor WHERE id=10; </p>

<!--form action="<?php $_SERVER['PHP_SELF'];?>" method="get"-->
<form action="./movieDBQuery.php" method="get">
<!--<form action="<?php $_SERVER['REQUEST_URI'];?>" method="get">-->
<textarea rows="4" cols"50" name="query"></textarea>
<br>
<input type="submit" name="submit" value="submit query">
</form>

<?php

if(isset($_GET["submit"])){
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
if($num_rows == 0)
{
	print "No answer found.";
	exit(1);
}

if ($_GET["submit"] && !sizeof($print_array)) {
   print "No answer found.";
}

else {
   print '<table border="1"><tr>';
   foreach(array_keys($print_array) as $col) {
   print '<td>' . $col . '</td>';
}
   
   //print "<br />";
print '</tr>';

mysql_data_seek($result, 0);
while($print_array = mysql_fetch_assoc($result)) {
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
}
?>

</div>
<!--END MOVIEDB-->

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
