<<<<<<< HEAD
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Delete view</title>
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Steven">
</head>

=======
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Movie</title>
</head>
>>>>>>> 57f78c5536d7471186b732bdca7e993872a78e82
<body>
<h1>Delete Movie</h1>
<?php if (!isPost()) : ?>
    <p>Segur que vols esborrar la pel·lícula <?= $data["title"] ?>?
    <form action="movies-delete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data["id"] ?>">

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
<<<<<<< HEAD
</body>

=======

</body>
>>>>>>> 57f78c5536d7471186b732bdca7e993872a78e82
</html>