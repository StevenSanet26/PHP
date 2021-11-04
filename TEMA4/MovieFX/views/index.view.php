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
    <h1>Movies</h1>
    <ul>
        <?php foreach ($movies as $movie): ?>
            <li><a href="movie.php?id=<?=$movie->getId()?>"><?=$movie->getTitle()?></a>
                <ul>
                    <li><a href="movies-edit.php?id=<?=$movie->getId()?>">Editar</a>
                    <li><a href="movies-delete.php?id=<?=$movie->getId()?>">Borrar</a>
                </ul>
            </li>
        <?php endforeach;?>
    </ul>
    <p><a href="movies-create.php">New movie</a></p>
</body>
</html>