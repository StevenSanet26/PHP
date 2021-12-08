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
    try {
        if (validate_string($_POST["model"], 1, 100))
            $car["model"] = clean($_POST["model"]);
    } catch (ValidationException $e) {
        $errors[] = "model: " . $e;
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
        $errors[] = "Description: " . $e;
    }

    if (!empty($_POST["registration_date"]) && validate_date($_POST["registration_date"])) {
        $car["registration_date"] = clean($_POST["registration_date"]);
    } else {
        $errors[] = "Error en el registration_date";
    }
}

if (isPost() && empty($errors)) {
    $pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8", "dbuser", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("UPDATE car 
                            set model = :model, 
                                photo=:photo,
                                price =:price, 
                                description = :description, 
                                registration_date=:registration_date
                                WHERE id = :id");
    $stmt->execute($car);

    if ($stmt->rowCount() !== 1)
        $errors[] = "No s'ha pogut actualitzar el registre";
    else
        $message = "S'ha actualitzat el registre amb l'ID ({$car["id"]})";
}
require "views/cars_edit.view.php";