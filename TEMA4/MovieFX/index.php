<?php
declare(strict_types=1);
require "src/Movie.php";
//require "movies.inc.php";

//Connexió a la base de dades.
$pdo = new PDO("mysql:host=myslq-server;dbname=movieFX;charset=utf8","dbuser","1234");
//Prequè generi excepcions a l'hora de reportar errors.
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Es realitza la consulta
$moviesStmt = $pdo->prepare("SELECT * FROM movie");
// Torna les dades en un array associatiu pel nom de camp de la taula.
$moviesStmt->setFetchMode(PDO::FETCH_ASSOC);
$moviesStmt->execute();

// fetchAll tornarà un array les dades de pel·lícules en un altre array
// caldrà mapejar les dades
$moviesAr = $moviesStmt->fetchAll();

foreach ($moviesAr as $movieAr){
    $movie=new Movie();
    $movie->setId((int)$movieAr["id"]);
    $movie->setTitle($movieAr["title"]);
    $movie->setPoster($movieAr["poster"]);
    $movie->setReleaseDate($movieAr["release_date"]);
    $movie->setOverview($movieAr["overview"]);
    $movie->setRating((float)$movieAr["rating"]);
    $movies[]=$movie;
}
require "views/index.view.php";
