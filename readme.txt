
Part 1B

The create.sql file contains the SQL script that creates tables (it also
includes the restraints as well).

The load.sql file contains the SQL script that loads the data into the
tables from the .del files.

The queries.sql file contains the 3 queries we wrote.

The query.php file contains the code for the web query interface.

The violate.sql contains the SQL modification statements that violate
each constraint written in create.sql it also includes the error 
output MySQL prints out.

Kelly worked on create.sql and load.sql and queries.sql.

Sharon worked on query.php and violate.sql.


////////////////////////////////////////////////////////////////////


Part 1C

We were able to implement all five input pages:

----A page that lets users to add actor and/or director information.
	* Located in addActorDir.php.

----A page that lets users to add movie information.
	* Located in addMovie.php.

----A page that lets users to add comments to movies.
	* Located in comment.php.

----A page that lets users to add "actor to movie" relation(s).
	* Located in addMovActRel.php.

----A page that lets users to add "director to movie" relation(s).
	* Located in addMovDirRel.php.


We were able to implement both browsing pages with all required
funcitonality:

----A page that shows actor information and links to the movies
	that the actor was in.
	* Located in actorInfo.php.

----A page that shows movie information, with links to the
	actors/actresses that were in this movie, as well as user comments
	and the average score of the movie based on user feedback. Contains
	"Add Comment" button which links to page where users can add
	comments.
	* Located in movieInfo.php.

We were able to implement one search page:
----A page that lets users search for an actor/actress/movie through
	a keyword search interface. Supports multi-word search.
	* Located in search.php.


Team responsibilities:

----Kelly worked on front-end display, as well as pulling information
	from relevant tables to display information and creating working
	links between pages.

----Sharon implemented search functionality and the ability to add
	new tuples to or update information on relevant tables in the
	database.


Ways to improve team collaboration:

----In terms of improving teamwork, our team could have done better
	in taking the time at the beginning of the project to discuss all
	the different aspects of the project (e.g. creating a timeline
	for certain features or pages).

----While this did not hinder our work, our team could have benefited
	from a more structure plan of action.


////////////////////////////////////////////////////////////////////

