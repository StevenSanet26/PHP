<?php
declare(strict_types=1);

require "helpers.php";
require 'Exceptions/FileUploadException.php';
require_once 'Exceptions/NoUploadedFileException.php';
require_once 'src/Movie.php';

const MAX_SIZE = 1024*1000;

// En el cas de l'edició els valors inicials haurien de ser els de l'objecte a actualitzar, així
// que caldria inicialitzar l'array $data  tant en l'opció de post com en la get

if (isPost()) {
    $idTemp = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
}else{
    $idTemp = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
}

if (!empty($idTemp)) {
    $id = $idTemp;
}else {
    throw new Exception("Id Invalid");
}

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

$validTypes = ["image/jpeg", "image/jpg"];
$errors = [];

// per a la vista necessitem saber si s'ha processat el formulari
if (isPost()) {

    $idTemp = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    if (!empty($idTemp)) {
        $data["id"] = $idTemp;
    }else {
        throw new Exception("Invalid ID");
    }

    try {
        if (validate_string($_POST["title"], 1, 100))
            $data["title"] = clean($_POST["title"]);

    } catch (Exception $e) {
        $errors[] = "title:".$e->getMessage();
    }

    try {
        if (validate_string($_POST["overview"], 1, 1000))
            $data["overview"] = clean($_POST["overview"]);

    } catch (Exception $e) {
        $errors[] = "overview:".$e->getMessage();
    }

    if (!empty($_POST["release_date"]) && (validate_date($_POST["release_date"]))) {

        $data["release_date"] = $_POST["release_date"];
    } else {
        $errors[] = "Cal indicar una data correcta";
    }

    //La puntuacio no es modifica ja que es una mitjana de moltes persones

    try {
        if (!empty($_FILES['poster']) && ($_FILES['poster']['error'] == UPLOAD_ERR_OK)) {
            if (!file_exists(Movie::POSTER_PATH))
                mkdir(Movie::POSTER_PATH, 0777, true);

            $tempFilename = $_FILES["poster"]["tmp_name"];
            $currentFilename = $_FILES["poster"]["name"];

            $mimeType = getFileExtension($tempFilename);

            $extension = explode("/", getFileExtension($tempFilename))[1];
            $newFilename = md5((string)rand()) . "." . $extension;
            $newFullFilename = Movie::POSTER_PATH . "/" . $newFilename;
            $fileSize = $_FILES["poster"]["size"];

            if (!in_array($mimeType, $validTypes))
                throw new InvalidTypeFileException("La foto no és jpg");

            if ($extension != 'jpeg')
                throw new InvalidTypeFileException("La foto no és jpg");

            if ($fileSize > MAX_SIZE)
                throw new TooBigFileException("La foto té $fileSize bytes");

            if (!move_uploaded_file($tempFilename, $newFullFilename))
                throw new FileUploadException("No s'ha pogut moure la foto");

            $data["poster"] = $newFilename;

        } //else
        //  throw new NoUploadedFileException("Cal pujar una photo");
    } catch (FileUploadException $e) {
        $errors[] = $e->getMessage();
    }

    if (isPost() && empty($errors)) {
        //Connexió a la base de dades.
        $pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8","dbuser","1234");
//Prequè generi excepcions a l'hora de reportar errors.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

        //Es realitza la consulta
        $moviesStmt = $pdo->prepare("UPDATE movie 
                            set title = :title, 
                                overview = :overview, 
                                release_date =:release_date, 
                                rating = :rating, 
                                poster=:poster
                                WHERE id = :id");

        $moviesStmt->execute($data);

        //rowCount() ens torna el número de files afectades por una sentència DELETE, INSERT, o UPDATE.
        if ($moviesStmt->rowCount() !== 1)
            $errors[] = "No s'ha pogut inserir el registre";
        else
            $message = "S'ha actualitzat el registre amb el ID ({$data["id"]})";
    }

}
require "views/movies-edit.view.php";

