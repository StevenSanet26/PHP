<?php
echo "1. Crea un array amb els noms de diversos alumnes de la classe incloent el teu.<br>";
$alumnes = ["Joan", "Steven", "Ruben", "Salva", "Saoro", "Jordi"];
$alumnesInicial = $alumnes;
print_r($alumnes);
echo "<p></p>";

echo "2. Mostra el nombre d'elements que té l'array (count).<br>";
echo count($alumnes);
echo "<p></p>";

echo "3. Crea una cadena de text que continga els noms dels alumnes existents en l'array separats per un espai i mostra-la (implode).<br>";
implode($alumnes);
foreach ($alumnes as $array) {
    echo $array . " ";
}
echo "<p></p>";

echo "4.Mostra l'array en un ordre aleatori diferent al que ho vas crear (shuffle).<br>";
shuffle($alumnes);
foreach ($alumnes as $array) {
    echo $array . " ";
}
echo "<p></p>";

echo "5.Mostra l'array ordenat alfabèticament (sort).<br>";
sort($alumnes);
foreach ($alumnes as $array) {
    echo $array . " ";
}
echo "<p></p>";

echo "6.Mostra els alumnes el nom dels quals continga almenys una “a” (array_filter).<br>";


function filter($v)
{
    if (stripos($v, "a") !== false) {
        return true;
    }
    return false;
}

$filterArray = array_filter($alumnes, "filter");
foreach ($filterArray as $array) {
    echo $array . " ";
}
echo "<p></p>";

echo "7.Mostra l'array en l'ordre invers al que es va crear (rsort).<br>";
krsort($alumnesInicial);
foreach ($alumnesInicial as $array) {
    echo $array . " ";
}
echo "<p></p>";

echo "8.Mostra la posició que té el teu nom en l'array (array_search).<br>";
echo array_search("Steven", $alumnes);

?>