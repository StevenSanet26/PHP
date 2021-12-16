<?php
//declare(strict_types=1);
require "../bootstrap.php";

$router = new AltoRouter();

// map controller
$router->map('GET', '/', 'MovieController#list', 'movie_list');

// map controller with params
$router->map('GET|POST', '/movies/[i:id]/edit', "MovieController#edit", 'movie_edit');

// echo URL to user-details page for ID 5
echo $router->generate('user-details', ['id' => 5]); // Output: "/users/5"

$match = $router->match();
var_dump($match);


if (is_array($match)) {
    $temp = explode("#", $match["target"]);
    $controller = $prefix . $temp[0];
    $action = $temp[1];
    if (method_exists($controller, $action)) {
        $object = new $controller;
        call_user_func_array([$object, $action], $match['params']);
    } else {
        // no route was matched
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo "error";
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "error";
}