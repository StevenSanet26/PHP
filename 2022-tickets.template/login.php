<?php
declare(strict_types=1);

require 'helpers.php';
session_start();
$username="";
$password="";
$errors=[];

function login($username, $password): bool
{
    $pdo = new PDO("mysql:host=mysql-server;dbname=ticket;charset=utf8","root","secret");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $stmt=$pdo->prepare("SELECT * FROM user 
                           WHERE username=:name 
                           AND password=:pwd");
    $stmt->bindValue("name",$username);
    $stmt->bindValue("pwd",$password);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $user=$stmt->fetch();

    return ($user!==false);
}

if (isPost()) {
    $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password=filter_input(INPUT_POST,"password");
    try{
        validate_string($username,1,255);
        validate_string($password,1,255);

        if (login($username,$password)){
            $message="Has iniciat sessio";
            $_SESSION["logged"]=true;
        }else{
            $errors[]="Login incorrecte";
        }

    }catch (ValidationException $e){
        $errors[]="Error en procesar: ".$e->getMessage();
    }
}

require_once 'views/login.view.php';
