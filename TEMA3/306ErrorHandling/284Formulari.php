<?php

require "helper.php";
require "ValidationException.php";
require "RequiredValidationException.php";
require "TooShortValidationException.php";
require "TooLongValidationException.php";
require "InvalidPhoneValidationException.php";
require "InvalidEmailValidationException.php";
require "InvalidKeyValidationException.php";

$firstname = "";
$lastname = "";
$phone = "";
$email = "";
$errors = [];

$genere="";
$hobbies=[];
$time=[];


$arrayGenere=[
    "home"=>"Home",
    "dona"=>"Dona",
    "NoBinari"=>"No binari"
];
$arrayHobbies=[
    "lectura"=>"Lectura",
    "programacio"=>"Programacio",
    "Ciclisme"=>"Ciclisme",
    "Running"=>"Running"
];
$arrayTime=[
    "PrimeraHora"=>"Primera hora (08:00 a 10:00)",
    "AbansDinar"=>"Abans de dinar (12:00 a 13:00)",
    "DespresDinar"=>"Després de dinar (14:00 a 16:00)",
    "PerNit"=>"Per la nit (20:00 a 22:00)"
];



// per a la vista necessitem saber si s'ha processat el formulari
$isPost = false;

if (isPost()) {

    $isPost = true;

    try {
        if (validate_firstname($_POST["firstname"], 1, 25)) {
            $firstname = clear($_POST["firstname"]);
        }
    } catch (Exception $e) {
        $errors[]=$e->getMessage();
    }


    try {
        if (validate_lastname($_POST["lastname"], 1, 50)) {
            $lastname= clear($_POST["lastname"]);
        }

    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }


    try {
        if (validate_phone($_POST["phone"])) {
            $phone = $_POST["phone"];
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }


    try {
        if (validate_email($_POST["email"])) {
            $email = $_POST["email"];
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }


    //GENERE
    if(empty($_POST["genere"])){
        $errors[] = "Genere requerit";
    }else{
        $genere=$_POST["genere"];
    }


    //HOBBIES
    if (is_empty($_POST["hobbies"] ?? [])) {
        $errors[] = "Hobbies buit";
    } else {
      $hobbies=$_POST["hobbies"];

    }

    //TIME
    if (is_empty($_POST["time"] ?? [])) {
        $errors[] = "Horas esta vacio";
    } else {
      $time=$_POST["time"];
    }


    //ACTIVITAT 281FormulariIMatge.php
    //ACTIVITAT 282FOrumulariIMatge.php

    //print_r($_FILES);
    $random=rand();
    $nombre=$_FILES["archivo"]["name"];
    $guardado=$_FILES["archivo"]["tmp_name"];

    $tipo=$_FILES["archivo"]["type"];
    $tamano=$_FILES["archivo"]["size"];



        if (!file_exists("archivos")){
            mkdir("archivos",0777,true);
            if (file_exists("archivos")){
                if (move_uploaded_file($guardado, "archivos/".$random)){
                    echo "archivo guardado";
                    echo "<img src='archivos/".$guardado."'/>";
                }else{
                    echo "Archivo no encontrado";
                }
            }
        }else {

            if (file_exists("archivos")) {
                if (strpos($tipo,"jpeg")||strpos($tipo,"jpg")){
                    echo "es una imatge jpg";
                    if ($tamano<1048576){
                        echo "El tamaño es correcto";
                        if (move_uploaded_file($guardado, "archivos/" . $random)) {
                            echo "archivo guardado2";
                        }

                    } else{
                       $errors[]="El tamaño no es el correcto";
                    }
                }else{
                    $errors[]="no es una imatge jpg";
                }

            }
       }



}
require "284Formulari.view.php";