<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieFX</title>
</head>
<body>
<h1>Movie</h1>
    <?php if (!empty($movie)):?>
        <h2><?=$movie->getTitle()?></h2>
        <figure>
            <img style="width: 100px" alt="<?=$movie->getTitle()?>" src="<?=Movie::POSTER_PATH?>/<?=$movie->getPoster()?>">
        </figure>
        <p><?=$movie->getOverview()?></p>
    <?php else:?>
        <h3><?=array_shift($errors)?></h3>
    <?php endif;?>
</body>
</html>