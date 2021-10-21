<?php
echo "<p>1.Mostra la data i hora actuals amb el format: dd/mm/yyyy hh:mm:ss</p>";
echo date("d/m/Y H;i", time() );


echo "<p>2.Mostra el nom de la zona horària que s'utilitza per defecte.</p>";
echo date_default_timezone_get();


echo "<p>3.Mostra la data de que serà d’ací 45 dies.</p>";
$hoy=date("d-m-Y");
echo date("d-m-Y", strtotime($hoy."+ 45 days"));


echo "<p>4.Mostra el nombre de dies que han passat des de l'1 de gener.</p>";
$data = mktime(0,0,0,1,1,2021);
$diferencia=time()-$data;
$diferenciaEnDies=((($diferencia/60)/60)/24);
echo "".round($diferenciaEnDies);

echo "<p>5.Mostra la data i hora actuals de Nova York.</p>";
$nueva_York= date_default_timezone_set("America/New_York");
$fechaHora = date("Y-m-d , h:m:s");
echo $fechaHora;


echo "<p>6.Mostra el dia de la setmana que era l'1 de gener d'enguany.</p>";
mktime(0,0,0,1,1,2021);

echo date("l");

?>
