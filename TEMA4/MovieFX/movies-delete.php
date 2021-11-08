<?php
declare(strict_types=1);
require "helpers.php";
require 'Exceptions/FileUploadException.php';
require_once 'Exceptions/NoUploadedFileException.php';
require_once 'src/Movie.php';

// En el cas de esborrar els valors inicials haurien de ser els de l'objecte a actualitzar, així
// que caldria inicialitzar l'array $data  tant en l'opció de post com en la get

if (isPost())

    $idTemp = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
else
    $idTemp = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


if (!empty($idTemp))
    $id = $idTemp;
else
    throw new Exception("Id Invalid");


//Connexió a la base de dades.
$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
//Prequè generi excepcions a l'hora de reportar errors.
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Es realitza la consulta per editar
$moviesStmt = $pdo->prepare("SELECT * FROM movie WHERE id=:id");
//s'assigna el valor de la variable a aquest paràmetre just en el moment d'executar la instrucció bindValue
$moviesStmt->bindValue("id",$id);
// Torna les dades en un array associatiu pel nom de camp de la taula.
$moviesStmt->setFetchMode(PDO::FETCH_ASSOC);
$moviesStmt->execute();

//Obtiene la siguiente fila de un conjunto de resultados
$data = $moviesStmt->fetch();

if (isPost()) {

$idTemp = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$response = filter_input(INPUT_POST, "response", FILTER_SANITIZE_SPECIAL_CHARS);


if ($response!=="Sí")
    $errors[] = "L'esborrat ha sigut cancelat per l'usuari";

if (!empty($idTemp))
    $id = $idTemp;
else
    throw  new Exception("Invalid ID");

}

if (isPost() && empty($errors)) {
    //Connexió a la base de dades.
    $pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
//Prequè generi excepcions a l'hora de reportar errors.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Es realitza la consulta
    $moviesStmt = $pdo->prepare("DELETE FROM movie
                                WHERE id = :id");

    $moviesStmt->bindValue("id", $id, PDO::PARAM_INT);
    $moviesStmt->execute();
//rowCount() ens torna el número de files afectades por una sentència DELETE, INSERT, o UPDATE.
    if ($moviesStmt->rowCount() !== 1)
        $errors[] = "No s'ha pogut inserir el registre";
    else
        $message = "S'ha esborrat el registre amb el ID ({$data["id"]})";
}
require "views/movies-delete.view.php";
