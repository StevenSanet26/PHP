<?php

$pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8","dbuser","1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$stmt=$pdo->prepare("SELECT * FROM car");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$carsStmt= $stmt->fetchAll();
foreach ($carsStmt as $car){
    $cars[]=$car;
}


require "views/index.view.php";