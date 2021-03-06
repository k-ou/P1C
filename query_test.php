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
   <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <!--ADD NEW dropdown-->
      <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add New Content <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li role="presentation"><a href=".addActorDir" role="tab" data-toggle="tab">Add Actor/Director</a></li>
          <li role="presentation"><a href=".addMovie" role="tab" data-toggle="tab">Add Movie Information</a></li>
          <li role="presentation"><a href=".addMovActRel" role="tab" data-toggle="tab">Add Movie/Actor Relation</a></li>
          <li role="presentation"><a href=".addMovDirRel" role="tab" data-toggle="tab">Add Movie/Director Relation</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
      <!--end ADD NEW dropdown-->
      <!--start BROWSE dropdown-->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li role="presentation"><a href=".actorInfo" role="tab" data-toggle="tab">All Actors/Actresses</a></li>
          <li role="presentation"><a href=".movieInfo" role="tab" data-toggle="tab">All Movies</a></li>
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
        <li role="presentation"><a href=".movieDBQuery" role="tab" data-toggle="tab">Enter Query</a></li>
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

<!--HOME-->
<div class="home tab-pane active" role="tabpanel">

<h1>Welcome to IMDB.</h1>

</div>
<!--END HOME-->

<!--MOVIE DB-->

<div class="movieDBQuery tab-pane" role="tabpanel">

  <h1>Movie Database Query</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Type a query in the following box, please use correct SELECT statements. <br>
  For example, type in SELECT * FROM Actor WHERE id=10; </p>

<!--form action="<?php $_SERVER['PHP_SELF'];?>" method="get"-->
<!--<form action="./movieDBQuery.php" method="get">-->
<form method="GET">
<!--<form action="<?php $_SERVER['REQUEST_URI'];?>" method="get">-->
<textarea rows="4" cols"50" name="query"></textarea>
<br>
<input type="submit" name="submit" value="submit query">
</form>


<!--PHP for Movie Data Query-->

<?php include 'movieDBQuery.php';?>


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
  <input type="submit" value="Submit">
</form>

<?php include 'addActorDir.php';?>


</div>
<!--END ADD ACTOR / DIR-->

<!--ADD MOVIE-->
<div class="addMovie tab-pane" role="tabpanel">

  <h1>Add Movie</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
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

</div>
<!--END ADD MOVIE-->

<!--START ADD MOVIE / ACTOR RELATION-->
<div class="addMovActRel tab-pane" role="tabpanel">

  <h1>Add Movie / Actor Relation</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Input a movie and the actor/actress that took part, as well as their role in the movie.</p>

</div>
<!--END ADD MOVIE / ACTOR RELATION-->

<!--START ADD MOVIE / DIRECTOR RELATION-->
<div class="addMovDirRel tab-pane" role="tabpanel">

  <h1>Add Movie / Director Relation</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Input a movie and the director that directed it.</p>

</div>
<!--END ADD MOVIE / ACTOR RELATION-->

<!--START ACTOR INFO-->
<div class="actorInfo tab-pane" role="tabpanel">

  <h1>Actor Info</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Select an actor or actress.</p>

</div>
<!--END ADD MOVIE / ACTOR RELATION-->

<!--START ADD MOVIE / DIRECTOR RELATION-->
<div class="movieInfo tab-pane" role="tabpanel">

  <h1>Movie Info</h1>
  <p>(Ver 1.0 10/26/2015 by Sharon Grewal and Kelly Ou)<br>
  Select a movie.</p>

</div>
<!--END ADD MOVIE / ACTOR RELATION-->

</div>

<!--END MIDSECTION-->

<div class="col-md-3 sidebar"></div>

<!--END CONTENT-->

</body>
</html>
