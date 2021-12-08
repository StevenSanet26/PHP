<?php
require "helpers.php";
//TODO: controlar si l'usuari s'ha validat
session_start();
$logged = $_SESSION["logged"];

if (!$logged) {
    die("<a href=\"login.php\">Iniciar Sessió</a>");
}

if (isPost()) {
    $idTemp = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
} else {
    $idTemp = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
}

if (!empty($idTemp)) {
    $id = $idTemp;
} else {
    throw new Exception("Id Invalid");
}

$pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8", "dbuser", "1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM car
                            WHERE id=:id");
$stmt->bindValue("id", $id);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$car = $stmt->fetch();

if (empty($car)) {
    throw new Exception("La pel·lícula seleccionada no existeix");
}


$errors = [];

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
    $pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8", "dbuser", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM car
                                WHERE id = :id");

    $stmt->bindValue("id", $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() !== 1)
        $errors[] = "No s'ha pogut borrar el registre";
    else
        $message = "S'ha borrart el registre amb l'ID ({$car["id"]})";
}


require "views/cars_delete.view.php";