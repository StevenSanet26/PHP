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
<h1>Esborrar Coche</h1>
<?php if (!isPost()) : ?>
    <p>Segur que vols esborrar el coche <?= $car["model"] ?>?
    <form action="cars_delete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $car["id"] ?>">

        <div>
            <input type="submit" name="response" value="Sí"/>
            <input type="submit" name="response" value="No"/>
        </div>
    </form>
<?php else: ?>
    <?php if (!empty($errors)): ?>
        <h2><?= array_shift($errors) ?></h2>
    <?php else: ?>
        <h2><?= $message ?></h2>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>