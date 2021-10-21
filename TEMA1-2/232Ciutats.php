<?php
declare(strict_types=1);

$habitants = [
    "Madrid" => ["comunitat"=>"MAD", "poblacio"=>3223334],
    "Sevilla" =>["comunitat"=>"AN","poblacio"=> 688711],
    "Murcia" => ["comunitat"=>"MU","poblacio"=> 447182],
    "Malaga" => ["comunitat"=>"AN","poblacio"=> 571026],
    "Zaragoza" => ["comunitat"=>"AR", "poblacio"=>666880],
    "Valencia" => ["comunitat"=>"CV","poblacio"=>791413],
    "Barcelona" => ["comunitat"=>"CAT","poblacio"=>1620343]
];
$poblacioTotal = 0;


echo "<table border='1px'>";

echo "<tr><th>Ciutat</th><th>Comunitat</th><th>Poblacio</th></tr>";

foreach ($habitants as $ciutat => $datos) {
    $poblacioTotal += $datos["poblacio"];
    echo "<tr>";
    echo "<td>" . $ciutat . "</td><td>" . $datos["comunitat"] . "</td><td>".$datos["poblacio"]."</td>";
    echo "</tr>";
}

echo "<tr><td>Total</td><td></td><td>" . $poblacioTotal . "</td></tr>";

echo "</table>";


echo "<h2>Ordenar per habitants</h2>";
echo "<table border='1px'>";

echo "<tr><th>Ciutat</th><th>Provincia</th><th>Poblacio</th></tr>";
array_multisort(array_column($habitants,"poblacio"),SORT_DESC,$habitants);

foreach ($habitants as $ciutat => $datos) {

    echo "<tr>";
    echo "<td>" . $ciutat . "</td><td>" . $datos["comunitat"] . "</td><td>".$datos["poblacio"]."</td>";
    echo "</tr>";
}
echo "</table>";


echo "<h2>Ordenar alfabèticament</h2>";

echo "<table border='1px'>";
echo "<tr><th>Ciutat</th><th>Provincia</th><th>Poblacio</th></tr>";
ksort($habitants);
foreach ($habitants as $ciutat => $datos) {

    echo "<tr>";
    echo "<td>" . $ciutat . "</td><td>" . $datos["comunitat"] . "</td><td>".$datos["poblacio"]."</td>";
    echo "</tr>";
}
echo "</table>";
?>
