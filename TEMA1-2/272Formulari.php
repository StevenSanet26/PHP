<?php

// Inicialitze les variables perquè existisquen en tots els possibles camins
// Sols emmagatzameré en elles valors vàlids.
// Acumularé els errors en un array per a mostrar-los al final.
// Use la sintaxi alternativa de les estructures de control per a la part de vistes.
// Cree funció clean per a netejar valors


require "helper.php";

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $isPost = true;


    if (validate_firstname()) {
        $errors[] = "Nombre requerido";
    } else {
        if (strlen($_POST["firstname"]) > 25) {
            $errors[] = "Nombre no valido, no puede superar los 25 carácteres";
        } else {
            $firstname = clear($_POST["firstname"]);
        }
    }

    if (validate_lastname()) {
        $errors [] = "Apellido requerido";
    } else {
        if (strlen($_POST["lastname"]) > 50) {
            $errors[] = "Apellido no valido, no puede superar los 50 carácteres";
        } else {
            $lastname = clear($_POST["lastname"]);
        }
    }

    if (validate_phone()) {
        $errors[] = "Telèfon requerit";
    } else {
        if (preg_match("/^\d{9}$/", $_POST["phone"])) {
            $phone = $_POST["phone"];
        } else {
            $errors[] = "Tlfn no valido, deben ser exactamente 9 digitos";
        }
    }

    if (validate_email()) {
        $errors[] = "Email requerit";
    } else {
        if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
            $email = $_POST["email"];
        } else {
            $errors[] = "Email erroni";
        }

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
require "271Formulari.view.php";