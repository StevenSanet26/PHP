<?php declare(strict_types=1); ?>
<?php
require "helper.php";
$title = ""; $description = ""; $dueDate = ""; $category = "";
$priority = 0; $errors = [];
$categories = [
    "pers" => "Personal",
    "work" => "Treball",
    "house" => "Casa",
    "hobbies" => "Aficions"
];
$priorities = [
    1 => "Baixa",
    2 => "Mitjana",
    3 => "Alta"
];
asort($categories);

$isPost=false;
if (isPost()) {
    $isPost=true;

    if (validate_string($_POST["title"], 1,1000)) {
        $title = clean($_POST["title"]);
    }else {
        $errors[] = "Error en validar el títol";
    }

    if (validate_string($_POST["description"], 1,300)) {
        $description = clean($_POST["description"]);
    }else {
        $errors[] = "Error en validar la descripció";
    }

    if(validate_date($_POST["due-date"])) {
        $dueDate = $_POST["due-date"];
    }else {
        $errors[] = "Cal indicar una data correcta";
    }

    if(!empty($_POST["category"]) && (array_key_exists($_POST["category"],$categories))) {
        $category = $_POST["category"];
    }else {
        $errors[] = "Has de triar una categoria vàlida";
    }

    $priorityTemp=filter_input(INPUT_POST,"priority",FILTER_VALIDATE_INT);

    if (!empty($priorityTemp) && ($priorityTemp >0 && $priorityTemp<=4)) {
        $priority = $priorityTemp;
    }else {
        $errors[] = "Tria una prioridad correcta";
    }
}
require 'index.view.php';
