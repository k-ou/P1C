/* Give me the names of all the actors in the movie 'Die Another Day'. Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space). */
SELECT DISTINCT CONCAT_WS(' ', first, last)
FROM Actor, MovieActor, Movie
WHERE Actor.id=MovieActor.aid AND MovieActor.mid=Movie.id AND title='Die Another Day';

/* Give me the count of all the actors who acted in multiple movies. */
SELECT COUNT(DISTINCT M1.aid)
FROM MovieActor AS M1, MovieActor AS M2
WHERE M1.mid <> M2.mid AND M1.aid = M2.aid;

/* Give me the count of all the distinct movies that have comedy as their genre. */
SELECT COUNT(DISTINCT mid)
FROM MovieGenre
WHERE genre="Comedy";
