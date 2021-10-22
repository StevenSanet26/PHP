<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Actividad 303</title>
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Vicent Jordà">
    <style>
        div.flex {
            display: flex;
            flex-wrap: wrap;
        }


        div.flex > div {
            flex: 0 0 100px;
            text-align: center;
        }

        div.flex > div img {
            width: 100px
        }
    </style>
</head>

<body>

<!--
<h1>304 -Playing game</h1>
<h2>Cards</h2>
<div class="flex">
    <?= $cards ?>
</div>
-->
<h2>Cartes jugador 1</h2>
<div class="flex">
    <?= $cardsPlayer1 ?>
</div>

<h2>Cartes jugador 2</h2>
<div class="flex">
    <?= $cardsPlayer2 ?>
</div>

<h2>Resultats parcials</h2>
<div class="flex">
    <?php foreach ($results as $partialResult): ?>
        <?php if ($partialResult > 0) : ?>
            <div>Jugador 1</div>
        <?php elseif ($partialResult < 0) : ?>
            <div>Jugador 2</div>
        <?php else : ?>
            <div>Empat!</div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<h2>Resultat</h2>
<?php if ($result > 0) : ?>
    <p>Guanya el jugador 1</p>
<?php elseif ($result < 0) : ?>
    <p>Guanya el jugador 2</p>
<?php else : ?>
    <p>Empat!</p>
<?php endif; ?>


</body>

</html>