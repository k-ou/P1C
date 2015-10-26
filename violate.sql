/* Movie */

/* Movie ids must be non-null & unique because it is used as a primary key.
ERROR 1062 (23000) at line 5: Duplicate entry '555' for key 'PRIMARY'*/

INSERT INTO Movie(id, title, year, rating, company)
VALUES(555, NULL, 2015, 'PG', 'MGM');

/* title cannot be NULL for a Movie. */
INSERT INTO Movie(id, title, year, rating, company)
VALUES(5465, NULL, 2015, 'PG', 'MGM');

/* Year must be greater than zero for a Movie. */
INSERT INTO Movie(id, title, year, rating, company)
VALUES(5465, 'Movies', -92, 'PG', 'MGM');

/* Actor */
/*ERROR 1048 (23000) at line 22: Column 'id' cannot be null */
/* ID must be unique and non-null because it used for primary key. */

INSERT INTO Actor(id, last, first, sex, dob, dod)
VALUES(NULL, 'Bruin', 'Joe', 'Male', 1994-5-6, NULL);

/* DOB must come before DOD. */
INSERT INTO Actor(id, last, first, sex, dob, dod)
VALUES(98, 'Bruin', 'Joe', 'Male', 1994-5-6, 1980-9-7);

/* Director */

/* ID cannot be NULL for a Director. */
/*ERROR 1048 (23000) at line 32: Column 'id' cannot be null */
INSERT INTO Director(id, last, first, dob, dod)
VALUES(NULL, 'Doe', 'Jane', 1984-3-19, NULL);

/* MovieGenre */

/* mid must reference a valid id from Movie. */
/*ERROR 1452 (23000) at line 42: Cannot add or update a child row: a foreign
key constraint fails ('CS143', 'MovieGenre', CONSTRAINT 'MovieGenre_ibfk_1' 
FORIEGN KEY ('mid') REFERENCES 'Movie' ('id')) */

INSERT INTO MovieGenre(mid, genre)
VALUES(0, 'Drama');

/* MovieDirector */

/* mid must reference a valid id from Movie. */
/*ERROR 1452 (23000) at line 52: Cannot add or update a child row: a foreign
key constraint fails ('CS143', 'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_1'
FOREIGN KEY ('mid') REFERENCES 'Movie' ('id'))*/

INSERT INTO MovieDirector(mid, did)
VALUES (0, 123);

/* did must reference a valid id from Director. */
/*ERROR 1452 (23000) at line 59: Cannot add or update a child row: a foreign
key constraint fails ('CS143', 'MovieDirector', CONSTRAINT 'MovieDirector_ibfk_1'
FORIEGN KEY ('did' REFERENCES 'Director' ('id'))*/
INSERT INTO MovieDirector(mid, did)
VALUES(0, NULL);

/* MovieActor */

/* mid must reference a valid id from Movie. */
/*ERROR 1452 (23000) at line 68: Cannot add or update a child row: a foreign
key constraint fails ('CS143', 'MovieActor', CONSTRAINT 'MovieActor_ibfk_1'
FOREIGN KEY ('mid') REFERENCES 'Movie'('id')) */

INSERT INTO MovieActor(mid, aid, role)
VALUES(0, 142, 'Herself');

/*aid must reference a valid id from Actor. */
/*ERROR 1452 (23000) at line 76: Cannot add or update a child row: a foreign key
constraint fails ('CS143', 'MovieActor', CONSTRAINT 'MovieActor_ibfk_1' FOREIGN
KEY ('aid') REFERENCES 'Actor'('id'))*/

INSERT INTO MovieActor(mid, aid, role)
VALUES(5467, 10, 'Himself');

/* Review */

/* mid must reference a valid id from Movie. */
/*ERROR 1452 (23000) at line 78: Cannot add or update a child row: a foreign key
constraint fails ('CS143', 'Review' CONSTRAINT 'Review_ibfk_1' FOREIGN KEY
('mid') REFERENCES 'Movie' ('id'))*/
INSERT INTO Review(name, time, mid, rating, comment)
VALUES('Jane Doe', NULL, 0, 4, 'Good!');
