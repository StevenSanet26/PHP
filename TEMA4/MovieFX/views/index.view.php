<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Steven">
    <title>Index view</title>
</head>
<body>
    <h1>Movies of Steven</h1>
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