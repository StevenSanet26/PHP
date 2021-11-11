<?php
declare(strict_types=1);

session_start();
if (empty($_SESSION["user"]))
    die("<p><a href= \"login.php\">Login</a> or die!</p>");


require "helpers.php";
require "Exceptions/FileUploadException.php";
require "Exceptions/NoUploadedFileException.php";
require "Exceptions/TooBigFileException.php";
require "Exceptions/InvalidTypeFileException.php";
require "src/Movie.php";

const MAX_SIZE = 1034 * 1000;

$data["title"] = "";
$data["release_date"] = "";
$data["overview"] = "";
$data["poster"] = "";
$data["rating"] = 0;

$validTypes = ["image/jpeg", "image/jpg"];

$errors = [];

// per a la vista necessitem saber si s'ha processat el formulari
if (isPost()) {

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
    $ratingTemp = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_FLOAT);

    if (!empty($ratingTemp) && ($ratingTemp > 0 && $ratingTemp <= 5)) {
        $data["rating"] = $ratingTemp;
    } else {
        $errors[] = "El rating ha de ser un enter entre 1 i 5";
    }

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
            //Es guarda el tamany
            $fileSize = $_FILES["poster"]["size"];

            //Comprova si la extensio es troba en l'array[jpg]
            if (!in_array($mimeType, $validTypes))
                throw new InvalidTypeFileException("La foto no és jpg");
            //Comprova si la extensio es jpeg
            if ($extension != 'jpeg')
                throw new InvalidTypeFileException("La foto no és jpg");
            //Comprovar si la imatge supera el maxim de bytes permitit
            if ($fileSize > MAX_SIZE)
                throw new TooBigFileException("La foto té $fileSize bytes");
            //Comprova si la imatge te permisos
            if (!move_uploaded_file($tempFilename, $newFullFilename))
                throw new FileUploadException("No s'ha pogut moure la foto");

            $data["poster"] = $newFilename;

        } else
            throw new NoUploadedFileException("Cal pujar una photo");
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}

if (isPost() && empty($errors)){
    $pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8", "dbuser", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

    $moviesStmt = $pdo->prepare("INSERT INTO movie(title, overview, release_date, rating, poster) 
        VALUES (:title, :overview, :release_date, :rating, :poster)");

    //Esta es una función de depuración que vuelca directamente los datos en la salida habitual.
    $moviesStmt->debugDumpParams();
    $moviesStmt->execute($data);

//rowCount() ens torna el número de files afectades por una sentència DELETE, INSERT, o UPDATE.
    if ($moviesStmt->rowCount() !== 1)
        $errors[] = "No s'ha pogut inserir el registre";
    else
        //lastInsertId ens torna la clau primària (id) del últim registre inserit en la base de dades.
        $message = "S'ha actualitzat el registre amb el ID ({$pdo->lastInsertId("movie")})";
}

require "views/movies-create.view.php";