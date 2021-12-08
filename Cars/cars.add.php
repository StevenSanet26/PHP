<?php
require "helpers.php";
const MAX_SIZE = 1024*1000;

$validTypes = ["image/jpeg", "image/jpg"];

$car["model"]="";
$car["price"]="";
$car["photo"]="";
$car["description"]="";
$car["registration_date"]="";
$errors=[];

if (isPost()){
    try {
        if (validate_string($_POST["model"], 1, 100))
            $car["model"] = clean($_POST["model"]);
    } catch (ValidationException $e) {
        $errors[] = "model: " . $e->getMessage();
    }

    if (!empty($_POST["price"])) {
        $car["price"] = clean($_POST["price"]);
    } else {
        $errors[] = "Error en el price";
    }

    try {
        if (validate_string($_POST["description"], 1, 255)) {
            $car["description"] = clean($_POST["description"]);
        }
    } catch (ValidationException $e) {
        $errors[] = "Description: " . $e->getMessage();
    }

    if (!empty($_POST["registration_date"]) && validate_date($_POST["registration_date"])) {
        $car["registration_date"] = clean($_POST["registration_date"]);
    } else {
        $errors[] = "Error en el registration_date";
    }

    try {
        if (!empty($_FILES['photo']) && ($_FILES['photo']['error'] == UPLOAD_ERR_OK)) {
            if (!file_exists("img"))
                mkdir("img", 0777, true);

            $tempFilename = $_FILES["photo"]["tmp_name"];
            $currentFilename = $_FILES["photo"]["name"];

            $mimeType = getFileExtension($tempFilename);

            $extension = explode("/", getFileExtension($tempFilename))[1];
            $newFilename = md5((string)rand()) . "." . $extension;
            $newFullFilename =  "img/" . $newFilename;
            //Es guarda el tamany
            $fileSize = $_FILES["photo"]["size"];

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

if (isPost() && empty($errors)) {
    $pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8", "dbuser", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $moviesStmt = $pdo->prepare("INSERT INTO car(model, photo, price, description, registration_date) 
        VALUES (:model, :photo, :price, :description, :registration_date)");

    $moviesStmt->execute($car);

    if ($moviesStmt->rowCount() !== 1)
        $errors[] = "No s'ha pogut inserir el registre";
    else {
        $message = "S'ha inserit el registre amb el ID ({$car->lastInsertId("car")})";
    }
}


require "views/cars_add.view.php";
