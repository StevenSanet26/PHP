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
<?php if (empty($errors)):?>
    <h2><?=$car["model"]?></h2>
    <p><?=$car["description"]?></p>
    <p><?=$car["registration_date"]?></p>
    <p><?=$car["price"]?></p>
    <img src="<?=$car["photo"]?>.jpg" alt="mercedes">
<?php else:?>
    <?=print_r($errors)?>;
<?php endif;?>

<p><a href="cars_edit.php?id=<?=$car["id"]?>">Editar coche</a></p>
<p><a href="cars_delete.php?id=<?=$car["id"]?>">Borrar coche</a></p>
</body>
</html>