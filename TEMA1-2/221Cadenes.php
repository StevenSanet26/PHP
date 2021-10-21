<?php
declare(strict_types=1);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activitat 1</title>
</head>
<body>
<h1>Activitat 1</h1>
<p>1.Elimina els espais del principi i el final del nom si els hi haguera (trim).</p>
<?php
$name = " Steven ";
echo "<p>Soc" . $name . "Pujos</p>";
echo "<p>Soc" . trim($name) . "Pujos<p>";
?>

<p>2.Elimina la lletra a del principi i el final del nom si els hi haguera (trim)</p>
<?php
$name = "anna";
$name2 = trim($name, "a");
echo "<p>$name</p>";
echo "<p>$name2</p>";

?>

<p>3.Mostra la variable nom en majúscules, minúscules i amb la primera lletra en majúscula i les altres en minúscules
    (strtoupper, strtolower, ucfirst).</p>
<?php
$name = "Steven";
$name1 = strtoupper($name);
echo "<p>$name1</p>";
$name2 = strtolower($name);
echo "<p>$name2</p>";
$name3 = ucfirst($name);
echo "<p>$name3</p>";
?>

<p>4.Mostra el codi ascii de la primera lletra del nom (ord).</p>
<?php
$name = "Steven";
$name1 = ord($name);
echo "<p>$name1</p>"
?>

<p>5.Mostra la longitud del nom (strlen).</p>
<?php
$name = "Steven";
$name1 = strlen($name);
echo "<p>$name1</p>"
?>

<p>6.Mostra el nombre de vegades que apareix la lletra a (majúscula o minúscula, substr_count)</p>
<?php
$name = "anna";
$name1 = substr_count($name, "a");

echo "<p>$name1</p>"
?>

<p>7.Mostra la posició de la primera a existent en el nom, siga majúscula o minúscula (strpos). Si no hi ha cap mostrarà
    -1.</p>
<?php
$name = "Anna";
$name1 = stripos($name, "a");
if ($name1 === false) {
    echo "-1";
} else {
    echo "<p>$name1</p>";
}
?>

<p>8.El mateix, però amb l'última a.</p>
<?php
$name = "Anna";
$name1 = strrpos($name, "a");
echo "<p>$name1</p>"
?>


<p>9.Mostra el nom substituint la lletr o pel número zero, siga majúscula o minúscula (str_replace).</p>
<?php
$name = "Pedro";
$name1 = str_replace("o", "0", $name);
echo "<p>$name1</p>"

?>

<p>10.Indica si el nomom comença per al o no.
</p>
<?php

$name = "Steven";
$name1 = stripos($name, "al");
if ($name1 === true) {
    echo "" . $name . "escomença per al";
} else {
    echo "" . $name . " no escomença per al";
}
?>

<h1>Activitat 2</h1>
<?php
$url='http://username:password@hostname:9090/path?arg=value#anchor';
echo $url."<br>";

echo "1.El protocol<br>";
$protocol=parse_url($url,PHP_URL_SCHEME);
echo $protocol."<br>";

echo "2.El nom d'usuari<br>";
$user=parse_url($url,PHP_URL_USER);
echo $user."<br>";

echo "3.El path<br>";
$path=parse_url($url,PHP_URL_PATH);
echo $path."<br>";

echo "4.El querystring<br>";
$query=parse_url($url,PHP_URL_QUERY);
echo $query."<br>";

?>


</body>

</html>