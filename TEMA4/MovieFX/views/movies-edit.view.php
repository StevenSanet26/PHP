<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Steven"
    <meta name="description" content="PHP, PHPStorm">
    <title>Edit view</title>
</head>
<body>
<h1>Edit view</h1>
<?php if (!isPost() || !empty($errors)):?>
<form action="movies-edit.php" method="post" enctype="multipart/form-data">
    <pre>
        <?php
        if (!empty($errors)){
            print_r($errors);
        }
        ?>
    </pre>

    <input type="hidden" name="id" value="<?= $data["id"] ?>">

    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?= $data["title"] ?>">
    </div>

    <div>
        <label for="release_date">Release date (YYYY-mm-dd)</label>
        <input type="text" id="release_date" name="release_date" value="<?= $data["release_date"] ?>">
    </div>

    <div>
        <label for="overview">Overview</label>
        <textarea id="overview" name="overview"><?= $data["overview"] ?></textarea>
    </div>

    <div>
        <p>Rating: <?=$data["rating"]?></p>
    </div>

    <div>
        <p>Poster: <?=$data["poster"]?></p>
        <!--<input type="hidden" name="poster" value="<?=$data["poster"]?>"/>-->
        <input type="file" name="poster" />

    </div>

    <div>
        <input type="submit" value="Actualizar">
    </div>
</form>

<?php endif;?>
<?php if (empty($errors) && isPost()) : ?>
    <h2><?=$message?></h2>
    <table>
        <tr>
            <th>Title</th>
            <td><?= $data["title"] ?></td>
        </tr>
        <tr>
            <th>Overview</th>
            <td><?= $data["overview"] ?></td>
        </tr>
        <tr>
            <th>Release date</th>
            <td><?= date("d/m/Y", strToTime($data["release_date"])) ?></td>
        </tr>
        <tr>
            <th>Rating</th>
            <td><?= $data["rating"] ?></td>
        </tr>
    </table>
<?php endif ?>
</body>
</html>
