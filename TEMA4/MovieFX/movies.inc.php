<?php
$movie = new Movie();
$movie->setId(1);
$movie->setTitle("Joker");
$movie->setPoster("joker.jpg");
$movie->setReleaseDate("2019-10-04");
$movie->setOverview("The passion of Arthur Fleck, a man ignored by society, is to make people laugh. However, a series 
    of tragic events will cause his world view to be distorted considerably, turning him into a brilliant criminal.");
$movie->setRating(4.50);

$movies[]=$movie;

$movie = new Movie();
$movie->setId(2);
$movie->setTitle("IT Capitol 2");
$movie->setPoster("IT.jpg");
$movie->setReleaseDate("2019-10-06");
$movie->setOverview("In the mysterious town of Derry, an evil clown named Pennywise returns 27 years later to 
    torment the already grown members of the Losers' Club, who are now further apart from each other.");
$movie->setRating(3.90);

$movies[]=$movie;

$movie = new Movie();
$movie->setId(3);
$movie->setTitle("Creed II");
$movie->setPoster("Creed.jpg");
$movie->setReleaseDate("2018-11-14");
$movie->setOverview("Supervised by the legendary Rocky Balboa, the spectacular fighter Adonis Johnson prepares for a 
    fight against the son of Iván Drago, the Soviet boxer who killed Apollo Creed in the ring.");
$movie->setRating(4.20);

$movies[]=$movie;