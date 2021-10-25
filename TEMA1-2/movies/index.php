<?php declare(strict_types=1); ?>

<?php

// Inicialitze les variables perquè existisquen en tots els possibles camins
// Sols emmagatzameré en elles valors vàlids.
// Acumularé els errors en un array per a mostrar-los al final.
// Use la sintaxi alternativa de les estructures de control per a la part de vistes.
// Cree funció clean per a netejar valors


require "helpers.php";

$genres = [
    "acc" => "Acció",
    "com" => "Comèdia",
    "thr" => "Thriller"
];

$title = "";
$releaseDate = "";
$overview = "";
$genre = "";
$rating = 0;

$errors = [];

// per a la vista necessitem saber si s'ha processat el formulari
$isPost = false;

if (isPost()) {

    $isPost = true;

    if (validate_string($_POST["title"], 1, 100 ))
        $title = clean($_POST["title"]);
    else
        $errors[] = "Error en validar el títol";

    if (validate_string($_POST["overview"], 1, 1000 ))
        $overview = clean($_POST["overview"]);
    else
        $errors[] = "Error en validar la sinopsi";


    if (!empty($_POST["release-date"]) && (validate_date($_POST["release-date"]))) 
        $releaseDate = $_POST["release-date"];
    else
        $errors[] = "Cal indicar una data correcta";        
        
    
    if (!empty($_POST["genre"]) && in_array($_POST["genre"], array_keys($genres)))
        $genre = $_POST["genre"];
    else
        $errors[]="Has de triar un gènere i ha de ser vàlid";        

    $ratingTemp = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_INT);
    
    if (!empty($ratingTemp) && ($ratingTemp >0 && $ratingTemp<=5)) 
        $rating = $ratingTemp;    
    else 
        $errors[] = "El rating ha de ser un enter entre 1 i 5";
}

require "index.view.php";
