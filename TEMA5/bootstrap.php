<?php
require_once "Registry.php";

//$conf = new Config();


$pdo = new PDO("mysql:host=localhost;dbname=movieFX;charset=utf8", "dbuser", "1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
Registry::set("PDO",$pdo);
