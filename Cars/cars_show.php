<?php


$errors=[];

$id=0;
$idTemp=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);

if (empty($idTemp)){
    $errors[]="no s'ha trobat el ID";
}else{
    $id=$idTemp;
}

$pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8","dbuser","1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$stmt=$pdo->prepare("SELECT * FROM car
                                WHERE id=:id");
$stmt->bindValue("id",$id);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$car= $stmt->fetch();

if (empty($car)){
    $errors[]="No s'ha trobat el coche";
}
require "views/cars_show.view.php";