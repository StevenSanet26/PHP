<?php
 declare(strict_types=1);
 require "helpers.php";
 session_start();
 $username="";
 $password="";
 $errors=[];
 $message="";

 function login($username, $password):bool{

     $pdo = new PDO("mysql:host=localhost;dbname=cars;charset=utf8","dbuser","1234");
     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

     $stmt =$pdo->prepare("SELECT * FROM user 
                           WHERE username=:name 
                           AND password=:pwd");
     $stmt->bindValue("name",$username);
     $stmt->bindValue("pwd",$password);

     $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $stmt->execute();

     $user=$stmt->fetch();

     return ($user!==false);
 }

 if (isPost()){
     $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $password=filter_input(INPUT_POST,"password");

         if (login($username,$password)){
             $message="Has iniciat sessio";
             $_SESSION["logged"]=true;

         }else{
             $errors[]="Login incorrect";
         }
 }

require "views/login.view.php";