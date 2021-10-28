<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Actividad 262: Formulari</title>
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Homer Simpson">
</head>

<body>
<form action="284Formulari.php"  enctype="multipart/form-data" method="post">
        <pre>
            <?php
                if (!empty($errors)){
                    print_r($errors);
                }
            ?>
        </pre>

    <div>
        <label for="firstname">Nom</label>
        <input type="text" name="firstname" value="<?= $firstname ?>">
    </div>

    <div>

        <label for="lastname">Cognoms</label>
        <input type="text" name="lastname" value="<?= $lastname ?>">
    </div>

    <div>
        <label for="phone">Telèfon</label>
        <input type="text" name="phone" value="<?= $phone ?>">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="<?= $email ?>">
    </div>

    <!--RADIO BUTTON-->
    <p>Elige tu genero: </p>
    <div>

        <?php foreach ($arrayGenere as $valor): ?>
            <input type="radio" name="genere" value="<?=$valor?>"
                <?php if($valor == $genere)
                    echo "checked";
                ?>
            >
            <label for="genere"><?=$valor?></label>
        <?php endforeach;?>

    </div>

    <!--CHECKBOX-->
    <p>Elige tus hobbies:</p>
    <div>
        <?php foreach ($arrayHobbies as $valor):?>

        <input type="checkbox" name="hobbies[]" value="<?=$valor?>"
            <?php
            if (is_selected($valor,$hobbies))
                echo "checked";
            ?>
        >
        <label for="hobbies"><?=$valor?></label>

        <?php endforeach;?>
    </div>


    <!--SELECT-->
    <p>Elige tus horas:</p>
    <select multiple name="time[]">
        <?php foreach ($arrayTime as $valor):?>
        <option value="<?=$valor?>"

            <?=is_selected($valor,$time) ? "selected":""?>

        ><?=$valor?></option>
        <?php endforeach;?>
    </select>

    <div>
        <input type="file" name="archivo">
    </div>

    <div>
        <input type="submit" value="Enviar">
    </div>
</form>

<?php if (empty($errors) && $isPost==true): ?>

    <!--Tabla para mostrar los datos correctamente-->
    <table border="1">
        <tr>
            <th>Nom</th><td><?= $firstname ?></td>
        </tr>
        <tr>
            <th>Cognom</th><td><?= $lastname ?></td>
        </tr>
        <tr>
            <th>Telèfon</th><td><?= $phone ?></td>
        </tr>
        <tr>
            <th>Correu</th><td><?= $email ?></td>
        </tr>
        <tr>
            <th>Genere</th><td><?=$genere?></td>
        </tr>
        <tr>
            <th>Hobbies</th>
            <td><?php foreach ($hobbies as $valor):?>
                <?=$valor?>
                <?php endforeach;?>
            </td>
        </tr>
        <tr>
            <th>Hora</th>
            <td><?php foreach ($time as $valor):?>
                    <?=$valor?>
                <?php endforeach;?>
            </td>
        </tr>
        <tr>
            <th>Image</th><td><img src="archivos/<?=$random?>"</td>

        </tr>

    </table>
<?php endif ?>
</body>

</html>
