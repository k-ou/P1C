
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

  <div class="search-page tab-content">

  <h1>Search Results</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Results get listed here.</p>

<?php

if (isset($_GET["search"])) {
  $db_connection = mysql_connect("localhost", "cs143", "");
  if (!$db_connection) {
    $errmsg = mysql_error($db_connection);
    print "Connection failed: $errmsg <br />";
    exit(1);
  }
  mysql_select_db("TEST", $db_connection);
  $searchQuery= $_GET["search"];
  if ($searchQuery == "") {
    print "Please enter a search query.";
    print "<div class='footer'>
        <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br></p>
        </div>";
    exit(1);
  }


  $search_list = explode(' ', $searchQuery);

  $actorQuery = 'SELECT id, first, last, dob FROM Actor WHERE 1 ';
  $dirQuery = 'SELECT id, first, last, dob FROM Director WHERE 1 ';
  $mQuery = 'SELECT id, title, year FROM Movie WHERE 1 AND Movie.title LIKE
  "%' . $searchQuery . '%"';


  foreach($search_list as $single)
  {
    $actorQuery .= ' AND (Actor.first LIKE "%'. $single .'%" OR Actor.last 
    LIKE "%'. $single .'%")';

    $dirQuery .= ' AND (Director.first LIKE "%'. $single . '%" 
    OR Director.last LIKE "%' . $single . '%")';
	
  }

  print "<h3>Actors/Actresses Search Results: <br></h3>";
  $a_result = mysql_query($actorQuery, $db_connection);
  if (sizeof($a_result) == 0)
    print "No actors or actresses found.";
  while($p_actors = mysql_fetch_assoc($a_result)){
    foreach($p_actors as $type => $row){
      if ($type == 'id') {
        print "<a href='./actorInfo.php?actor_list=" . $row . "&submit=Submit'>";
      }
      else if ($type == 'first') {
        print $row . " ";
      }
      else if ($type == 'last') {
        print $row . "</a>";
      }
      else if ($type == 'dob') {
        print "</a> (" . $row . ")";
      }
    }
    print '<br>';
  }
  print '<br>';

  print "<h3>Director Search Results: <br></h3>";
  $d_result = mysql_query($dirQuery, $db_connection);
  if (sizeof($d_result) == 0)
    print "No directors found.";
  mysql_data_seek($d_result, 1);
  while($p_dir = mysql_fetch_assoc($d_result)){
    foreach($p_dir as $type => $row){
      print $row . "\t";
    }
    print '<br>';
  }
  print '<br>';

  print "<h3>Movie Search Results: <br></h3>";
  $m_result = mysql_query($mQuery, $db_connection);
  if (sizeof($m_result) == 0)
    print "No movies found.";
  mysql_data_seek($m_result, 1);
  while($p_mov = mysql_fetch_assoc($m_result)){
    foreach($p_mov as $type => $row){
      if ($type == 'id') {
        print "<a href='./actorInfo.php?movie=" . $row . "&submit=Submit'>";
      }
      else if ($type == 'title') {
        print $row . "</a>";
      }
      else if ($type == 'year') {
        print "</a> (" . $row . ")";
      }
    }
    print '<br>';
  }
  print '<br>';


  if ($_GET["submit"] && !sizeof($result)) {
    print "No answer found.";
  }

  mysql_free_result($result);
  mysql_close($db_connection);
}
?>

</div>
<!--END SEARCH PAGE-->

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
