<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
//Crea un array d'alumnes on cada element siga un altre array que continga nom i edat de l'alumne.
$alumnes = [
        ["nom"=> "Steven",
            "edat" => 20],
    ["nom"=>"Ruben",
        "edat"=>19],
    ["nom" => "Joan",
        "edat" => 20],
    ["nom" => "Saoro",
        "edat" => 19]

];
//Crea una taula HTML en la qual es mostren totes les dades dels alumnes.
echo "<table border='1px'>";

echo "<tr><th>Nom</th><th>Edat</th></tr>";
foreach ($alumnes as $datos ){
    echo "<tr>";
    echo "<td>".$datos["nom"]."</td><td>".$datos["edat"]."</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";

//Utilitza la funció array_column per a obtenir un array indexat que continga únicament els noms dels alumnes i mostra’ls per pantalla.
$nom = array_column($alumnes, "nom");
print_r($nom);
echo "<br>";

//Crea un array amb 10 números i utilitza la funció array_sum per a obtenir la suma dels 10 nombres.
$numeros = [1,2,3,4,5,6,7,8,9,10];
echo "<p>Mitjana: ".array_sum($numeros)."</p>";

//Sense usar bucles for calcula la mitjana d'edat de l'alumnat.
$element =count($alumnes);
$mitjana =array_sum(array_column($alumnes,"edat"));

echo "<p>La mitjana es ".($mitjana/$element)."</p>";

?>
</body>
</html>

