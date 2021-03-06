<?php declare(strict_types=1);
use App\FlashMessage;
require_once 'bootstrap.php';
session_start();


//if (empty($_SESSION["user"]))
//    die("<p><a href= \"login.php\">Login</a> or die!</p>");

// Inicialitze les variables perquè existisquen en tots els possibles camins
// Sols emmagatzameré en elles valors vàlids.
// Acumularé els errors en un array per a mostrar-los al final.
// Use la sintaxi alternativa de les estructures de control per a la part de vistes.
// Cree funció clean per a netejar valors

if (isPost())
    die("Aquest pàgina sols admet el mètode GET");


const MAX_SIZE = 1024*1000;

$data["title"] = "";
$data["release_date"] = "";
$data["overview"] = "";
$data["poster"] = "";
$data["rating"] = 0;

$data = App\FlashMessage::get("data", $data);
$errors = App\FlashMessage::get("errors",[]);

var_dump($data);
var_dump($errors);

/*
    Token per a evitar atacs CSRF:
    1) Creem el token en mostrar el formulari
    2) En llegir-lo l'esborrem, ja no serà valid perquè ja s'ha processat satisfactòriament o no el formulari
    3) Si el token és invàlid cancelem l'execució

*/

$formToken =  bin2hex(random_bytes(16));
// sempre que es mostre el formulari caldrà emmagatzemar el token
// en aquest cas sempre que es sol·licite la pàgina
//$_SESSION["token"] = $formToken;
FlashMessage::set("token", $formToken);

require "views/movies-create.view.php";