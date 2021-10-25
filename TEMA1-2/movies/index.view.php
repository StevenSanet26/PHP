<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Actividad 274: Formulari</title>
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Homer Simpson">
    <style>
        body {
            font-family: "Bitstream Vera Serif"
        }
    </style>
</head>

<body>
    <?php if (!$isPost || !empty($errors)) :?>
    <form action="" method="post">
        <pre>
        <?php
        if (!empty($errors))
            print_r($errors)
        ?>
        </pre>
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="<?= $title ?>">
        </div>
        <div>
            <label for="release-date">Release date (YYYY-mm-dd)</label>
            <input type="text" name="release-date" value="<?= $releaseDate ?>">
        </div>
        <div>
            <p>Rating</p>
            <?php foreach ([1, 2, 3, 4, 5] as $ratingValue) : ?>
                <label for="genre<?= $ratingValue ?>">
                    <input id="genre<?= $ratingValue ?>" type="radio" name="rating" 
                        value="<?= $ratingValue ?>" <?= ($rating === $ratingValue) ? "checked":"" ?> >
                    <?= $ratingValue ?>
                </label>
            <?php endforeach ?>
        </div>

        <div>
            <p>Genre</p>
            <select name="genre">
                <option selected disabled value="">(choose a genre)</option>
                <?php foreach ($genres as $genreKey => $genreValue): ?>
                    <option <?= ($genreKey === $genre) ? "selected":"" ?> 
                        value="<?= $genreKey ?>"><?= $genreValue ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div>
            <label for="overview">Overview</label>
                <textarea id="overview" name="overview"><?= $overview ?></textarea>
        </div>

        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>
    <?php endif; ?>
    <?php if (empty($errors) && $isPost) : ?>
        <table>
            <tr>
                <th>Title</th>
                <td><?= $title ?></td>
            </tr>
            <tr>
                <th>Overview</th>
                <td><?= $overview ?></td>
            </tr>
            <tr>
                <th>Release date</th>
                <td><?= date("d/m/Y", strToTime($releaseDate)) ?></td>
            </tr>
            <tr>
                <th>Genre</th>
                <td><?= $genres[$genre] ?></td>
            </tr>
            <tr>
                <th>Rating</th>
                <td><?= $rating ?></td>
            </tr>

          

        </table>
    <?php endif ?>
</body>

</html>