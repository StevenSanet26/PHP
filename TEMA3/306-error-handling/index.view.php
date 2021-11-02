<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Actividad 306: Formulari amb exceptions</title>
    <meta name="description" content="PHP, PHPStorm">
    <meta name="author" content="Homer Simpson">
    <style>
        body {
            font-family: "Bitstream Vera Serif", serif}
    </style>
</head>

<body>
<?php if (!isPost() || !empty($errors)) :?>
<form action="" method="post" enctype="multipart/form-data">
        <pre>
        <?php
        if (!empty($errors))
            print_r($errors)
        ?>
        </pre>
    <div>
        <label for="firstname">Name</label>
        <input type="text" name="firstname" value="<?=$firstname?>">
    </div>
    <div>
        <label for="lastname">Cognoms</label>
        <input type="text" name="lastname" value="<?=$lastname?>">
    </div>
    <div>
        <label for="phone">Telèfon</label>
        <input type="text" name="phone" value="<?=$phone?>">
    </div>
    <div>
        <label for="email">Correu electrònic</label>
        <input id="email" type="text" name="email" value="<?=$email?>">
    </div>

    <div>
        <p>Génere</p>
        <label for="genre">
            <input id="genre" type="radio" name="genre" value="M"
                <?=($genre = "M")?"checked":""?>
            >
            Home
        </label>

        <label for="genre">
            <input id="genre" type="radio" name="genre" value="W"
                <?=($genre = "W")?"checked":""?>
            >
            Dona
        </label>
        <label for="genre">
            <input id="genre" type="radio" name="genre" value="N"
                <?=($genre = "N")?"checked":""?>
            >
            No binari
        </label>
    </div>

    <div>
        <p>Hobbies</p>
        <label for="hobbie1">
            <input id="hobbie1" <?=in_array("reading", $hobbies)?"checked":""?> type="checkbox" name="hobbies[]" value="reading">
            Lectura
        </label>
        <label for="hobbie2">
            <input id="hobbie2" <?=in_array("programming", $hobbies)?"checked":""?> type="checkbox" name="hobbies[]" value="programming">
            Programació
        </label>
        <label for="hobbie3">
            <input id="hobbie3" <?=array_key_exists("cycling", $hobbies)?"checked":""?> type="checkbox" name="hobbies[]" value="cycling">
            Ciclisme
        </label>
        <label for="hobbie3">
            <input id="hobbie3" <?=array_key_exists("running", $hobbies)?"checked":""?> type="checkbox" name="hobbies[]" value="running">
            Running
        </label>
    </div>
    <div>
        <p>Contact time</p>
        <select name="contact-time[]" multiple="multiple">
           <option <?=is_selected("range-1", $contactTime)?"selected":""?> value="range-1">Primera hora (08:00 a 10:00)</option>
            <option <?=is_selected("range-2", $contactTime)?"selected":""?> value="range-2"> Abans de dinar (12:00 a 13:00)</option>
            <option <?=is_selected("range-3", $contactTime)?"selected":""?> value="range-3">Després de dinar (14:00 a 16:00)</option>
            <option <?=is_selected("range-4", $contactTime)?"selected":""?> value="range-4">Per la nit (20:00 a 22:00)</option>
        </select>

    </div>
    <div>
        <p>Photo</p>
        <input type="file" name="photo" />
    </div>
    <div>
        <input type="submit" value="Enviar">
    </div>
</form>
<?php endif ?>
<?php if (empty($errors) && isPost()): ?>
    <table>
        <tr>
            <th>Nom</th>
            <td><?= $firstname ?></td>
        </tr>
        <tr>
            <th>Cognom</th>
            <td><?= $lastname ?></td>
        </tr>
        <tr>
            <th>Telèfon</th>
            <td><?= $phone ?></td>
        </tr>
        <tr>
            <th>Genere</th>
            <td><?= $genre ?></td>
        </tr>
        <tr>
            <th>Hobbies</th>
            <td><?php foreach($hobbies as $hobbie):?>
                    <p><?=$hobbie?></p>
                <?php endforeach;?>
            </td>
        </tr>

        <tr>
            <td><?php foreach($contactTime as $contact):?>
                    <p><?=$contact?></p>
                <?php endforeach;?>
            </td>
        </tr>
        <tr>
            <th>Correu</th>
            <td><?= $email ?></td>
        </tr>

        <tr>
            <th>
                Foto
            </th>
            <td>
                <img style="height: 100px" src="<?=$newFilename ?>" alt="Foto"/>
            </td>
        </tr>

    </table>
<?php endif ?>
</body>

</html>
