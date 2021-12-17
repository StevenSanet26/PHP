<?php
//declare(strict_types=1);
use App\Registry;

require "../bootstrap.php";

$router = new AltoRouter();

// map controller
$router->map('GET', '/', 'MovieController#list', 'movie_list');

// map controller with params
$router->map('GET|POST', '/movies/[i:id]/edit', "MovieController#edit", 'movie_edit');

// echo URL to user-details page for ID 5
echo $router->generate('user-details', ['id' => 5]); // Output: "/users/5"

//echo "Hola soc el controlador frontal;
$match = $router->match();

if ($match === false) {
    die("ruta no trobada");
}

var_dump($match);

echo "<h2>requested url: " . $_SERVER["REQUEST_URI"] . "</h2>";

// Executar el controlador
if (is_array($match)) {
    // "target" => "MovieController#edit";
    $target = explode("#", $match["target"]);
    // target=["movieController","edit"]
    $controller = "App\\Controler\\" . $target[0];
    $method = $target[1];
    if (method_exists($controller, $method)) {
        $object = new $controller;
        call_user_func_array([$object, $method], $match['params']);
    } else {
        // no route was matched
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo "Method not exists";
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "error";
}