<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Gestor de tasques</title>
</head>
<body>
    <?php if (!isPost() || !empty($errors)) : ?>
        <h1>Gestor de tasques</h1>
        <?php if (!empty($errors)) : ?>
            <p>Hi ha errors en processar el formulari: </p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <form action="" method="POST">

    <label for="title">Titol de la tasca
        <input id="title" name="title" type="text" value="<?= $title ?>" />
    </label>

    <label for="description">Descripció de la tasca
        <textarea name="description" rows="10" cols="45"><?= $description ?></textarea>
    </label>

    <label for="due-date">Data de finalització (YYYY-mm-dd)
        <input type="text" name="due-date" value="<?= $dueDate ?>" />
    </label>

    <p>Prioritat</p>
    <?php foreach ($priorities as $priorityKey => $priorityValue) : ?>
        <label for="priority">
            <input type="radio" name="priority" value="<?=$priorityKey?>"><?=$priorityValue?>
        </label>
    <?php endforeach ?>

        <div>
            <p>Categoria</p>
            <select name="category">
                <option selected disabled value="">(selecciona una categoria)</option>
                <?php foreach ($categories as $valor=>$opcio):?>
                <option value="<?=$valor?>" <?=($valor===$category) ? "selected":""?>><?=$opcio?></option>
                <?php endforeach;?>
            </select>
        </div>
        <input type="submit" value="Enviar" />
</form>
<?php endif; ?>
<?php if (empty($errors) && isPost()) : ?>
<h1>Dades de la tasca</h1>
<table>
    <tr>
        <th>Títol</th>
        <td><?= $title ?></td>
    </tr>
    <tr>
        <th>Descripció</th>
        <td> <?=$description?></td>
    </tr>
    <tr>
        <th>Data de finalització</th>
        <td><?= date("d/m/y ", strToTime($dueDate)) ?></td>
    </tr>
    <tr>
        <th>Categoria</th>
        <td><?=$categories[$category]?> </td>
    </tr>
    <tr>
        <th>Prioritat</th>
        <td><?=$priorities[$priority]?> </td>
    </tr>
    <?php endif; ?>
</body>
</html>
