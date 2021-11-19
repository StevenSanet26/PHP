<?php
declare(strict_types=1);

//TODO: controlar si l'usuari s'ha validat

$logged = $_SESSION["logged"] ?? false;
session_start();
if (!$logged){
    die("<a href=\"login.php\">Iniciar Sessió</a>");
}

$pdo = new PDO("mysql:host=mysql-server;dbname=ticket;charset=utf8","root","secret");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$stmt=$pdo->prepare("SELECT * FROM ticket 
                            ORDER BY created DESC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$tickets=$stmt->fetchAll();

require "views/tickets-list.view.php";