<?php
declare(strict_types=1);
require "src/Movie.php";

//require "movies.inc.php";
$id = 0;
$errors = [];
$movie = null;

$idTemp = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!empty($idTemp)) {
    $id = $idTemp;
}

//Connexió a la base de dades.
$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
//Prequè generi excepcions a l'hora de reportar errors.
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Es realitza la consulta
$moviesStmt = $pdo->prepare("SELECT * FROM movie WHERE id=:id");
//s'assigna el valor de la variable a aquest paràmetre just en el moment d'executar la instrucció bindValue
$moviesStmt->bindValue("id",$id);
// Torna les dades en un array associatiu pel nom de camp de la taula.
$moviesStmt->setFetchMode(PDO::FETCH_ASSOC);
$moviesStmt->execute();

//Obtiene la siguiente fila de un conjunto de resultados
$movieAr = $moviesStmt->fetch();

if (!empty($movieAr)) {
    $movie = new Movie();
    $movie->setId((int)$movieAr["id"]);
    $movie->setTitle($movieAr["title"]);
    $movie->setPoster($movieAr["poster"]);
    $movie->setReleaseDate($movieAr["release_date"]);
    $movie->setOverview($movieAr["overview"]);
    $movie->setRating((float)$movieAr["rating"]);
}
else
    $errors[] = "The requested film doesn't existix";

/*
$filteredMovies = array_filter($movies, function ($movie) use ($id){
   if($movie->getId()===$id){
       return true;
   }
   return false;
});

if (count($filteredMovies) === 1)
    $movie = array_shift($filteredMovies);
else
    $errors[] = "La pel·lícula sol·licitada no existeix";
*/
require "views/movie.view.php";
