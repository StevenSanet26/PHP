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
<h1>Editar coche</h1>

<?php if(!isPost() || !empty($errors)):?>
    <form action="cars_edit.php" method="POST" enctype="multipart/form-data">
        <pre>
            <?php
                if(!empty($errors)){
                    print_r($errors);
                }
            ?>
        </pre>

        <input type="hidden" name="id" value="<?=$car["id"]?>">
        <div>
            <label for="model">Model</label>
            <input type="text" name="model"  id="model" value="<?=$car["model"]?>">
        </div>

        </div>
        <div>
        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="<?=$car["price"]?>">
        </div>
            <div>
        <label for="description">Description</label>
        <textarea name="description" id="description"><?=$car["description"]?></textarea>
            </div>
                <div>
        <label for="registration_date">Registration_date</label>
        <input type="text" name="registration_date" id="registration_date" value="<?=$car["registration_date"]?>">
                </div>
        <input type="hidden" name="photo" value="<?=$car["photo"]?>">
        <div>
            <input type="submit" value="Editar">
        </div>
    </form>
<?php endif;?>
<?php if (empty($errors) && isPost()) : ?>
    <h2><?=$message?></h2>
    <table>
        <tr>
            <th>Model</th>
            <td><?= $car["model"] ?></td>
        </tr>
        <tr>
            <th>Registration_date</th>
            <td><?= date("d/m/Y", strToTime($car["registration_date"])) ?></td>
        </tr>
        <tr>
            <th>price</th>
            <td><?= $car["price"] ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?= $car["description"] ?></td>
        </tr>

    </table>
<?php endif ?>
</body>
</html>
