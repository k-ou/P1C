CREATE TABLE Movie(
       id INT NOT NULL,
       title VARCHAR(100) NOT NULL,
       year INT,
       rating VARCHAR(10),
       company VARCHAR(20),
       PRIMARY KEY(id), /*Every Movie must have a unique id.*/
       CHECK(title IS NOT NULL), /* Title is not null.*/
       CHECK(year >= 0) /* The year of the movie cannot be negative. */
) ENGINE=INNODB;
CREATE TABLE Actor(
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR (20) NOT NULL,
       sex VARCHAR(6),
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY(id), /*Every Actor must have a unique id. */
	CHECK(dob < dod) /* DOD must come after DOB. */
) ENGINE=INNODB;
CREATE TABLE Director(
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR(20) NOT NULL,
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY(id), /*Every Director must have a unique id. */
	CHECK(dob < dod) 
) ENGINE=INNODB;
CREATE TABLE MovieGenre(
       mid INT NOT NULL,
       genre VARCHAR(20),
       FOREIGN KEY (mid) references Movie(id)
	/* MovieGenre must reference a valid Movie (id) entry. */
) ENGINE=INNODB;
CREATE TABLE MovieDirector(
       mid INT NOT NULL,
       did INT NOT NULL,
UNIQUE(mid, did),
       FOREIGN KEY (mid) references Movie(id),
	/* MovieDirector must reference a valid Movie (id) entry. */
       FOREIGN KEY (did) references Director(id)
	/* MovieDirector must reference a valid Director (id) entry. */
) ENGINE=INNODB;
CREATE TABLE MovieActor(
       mid INT NOT NULL,
       aid INT NOT NULL,
       role VARCHAR(50) NOT NULL,
UNIQUE(mid, aid, role),
       FOREIGN KEY (mid) references Movie(id),
	/* MovieActor must reference a valid Movie (id) entry. */
       FOREIGN KEY (aid) references Actor(id)
	/* MovieActor must reference a valid Actor (id) entry. */
) ENGINE=INNODB;
CREATE TABLE Review(
       name VARCHAR(20) NOT NULL,
       time TIMESTAMP NOT NULL,
       mid INT NOT NULL,
       rating INT NOT NULL,
       comment VARCHAR(500),
UNIQUE(name, mid),
       FOREIGN KEY (mid) references Movie(id),
	/* Review must reference a valid Movie (id) entry. */
       CHECK(rating >= 0 AND rating < 6)
) ENGINE=INNODB;
CREATE TABLE MaxPersonID(
       id INT NOT NULL
) ENGINE=INNODB;
CREATE TABLE MaxMovieID(
       id INT NOT NULL
) ENGINE=INNODB;
