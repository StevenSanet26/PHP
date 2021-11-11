<?php
declare(strict_types=1);
require "src/Movie.php";
require "src/User.php";
//require "movies.inc.php";

const COOKIE_LAST_VISIT = "last_visit_date";
// we get the current cookie value
$lastVisit= filter_input(INPUT_COOKIE,COOKIE_LAST_VISIT, FILTER_VALIDATE_INT);

if (empty($lastVisit)){
    echo "<h2>Welcome</h2>";
}else{
    echo "<h2>Welcome, the last conection was " . date("d/m/Y H:i:s",$lastVisit) . "</h2>";
}

//Guardar el la ultima visita en les cookies
setcookie("last_visit_date", (string)time(), time() + 604800);


// Task 504

# index.php
// Activem el suport per a sessions
session_start();

// comprovem si es la primera visita
$visits = $_SESSION["visits"]??[];

// if not empty generate an HTML Unordered List
if (!empty($visits))
  echo "<ul><li>" . implode("</li><li>", array_map(function($v) {
            return date("d/m/Y h:i:s", $v);
        }, $visits)) . "</li></ul>";
else
     echo "<p>Benvigut! (versió sessió)!</p>";

// guardem en un array index
$_SESSION["visits"][] = time();



//Connexió a la base de dades.
$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
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

// treballaré en l'última película
echo "La pel·lícula {$movie->getTitle()} té una valoració de {$movie->getRating()}";

$user = new User(1, "Vicent");

$value = 5;

echo "<p>L'usuari {$user->getUsername()} la valora en $value punts</p>";

$user->rate($movie, $value);

echo "<p>La pel·lícula {$movie->getTitle()} té ara una valoració de {$movie->getRating()}</p>";


require "views/index.view.php";
