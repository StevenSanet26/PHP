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
<h1>Llista de coches</h1>
<ul>
<?php foreach ($cars as $car):?>

<li><a href="cars_show.php?id=<?=$car["id"]?>"><?=$car["model"]?></a></li>
<?php endforeach;?>

</ul>

<h2>Menu</h2>
<ul>
    <li><a href="cars.add.php">Añadir coche</a></li>
    <li>
        <a href="login.php">Login</a>
    </li>
    <li>
        <a href="logout.php">Logout</a>
    </li>
</ul>


</body>
</html>
