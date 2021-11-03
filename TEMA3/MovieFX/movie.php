<?php
declare(strict_types=1);
require "src/Movie.php";
require "movies.inc.php";
$id = 0;
$errors = [];
$movie = null;

$idTemp = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!empty($idTemp)) {
    $id = $idTemp;
}

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
require "views/movie.view.php";
