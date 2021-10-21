<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>241Funcions</title>
</head>
<body>
<h2>Escriu una funció per retornar una etiqueta HTML img</h2>
<?php

function imatge(string $url, string $alt = "No alternative text", int $width = 0, int $heigth = 0): string
{

    $img = "<img src=\"$url\" alt=\"$alt\" ";
    if ($width > 0) {
        $img .= " width=\"$width\" ";
    }

    if ($heigth > 0) {
        $img .= " heigth=\"$heigth\" ";
    }

    $img .= "/>";
    return $img;

}

echo imatge("https://st.depositphotos.com/1020341/4233/i/600/depositphotos_42333899-stock-photo-portrait-of-huge-beautiful-male.jpg", "", 150, 100);

?>
</body>
</html>




