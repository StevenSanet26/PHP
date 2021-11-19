<?php
$pdo = new PDO("mysql:host=localhost;dbname=todo-list;charset=utf8" , "user1","pancet");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt= $pdo->prepare("SELECT * FROM category");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$category=$stmt->fetchAll();
foreach ($category as $cat){
    $categories[]=$cat;
}

// TODO: 1. Inicialitzar variables
$data["title"]="";
$data["description"]="";
$data["due_date"]="";
$data["name"]="";

$erros=[];
// TODO: 2. Comprovar el mètode de sol·licitud



// TODO: 2.2. Processar el formulari
// TODO: 2.2. Obtenir les dades del formulari
// TODO: 2.3. Validar les dades
// TODO: 2.3. Comprovar si hi ha algún error de validació
// TODO: 2.3.2. Inserir en la base de dades

?>
<!DOCTYPE html>

<html>
<head>
    <title>Todo List</title>
    <style>
        label, input, textarea {display: block;}
        input, textarea { margin-bottom: 1em; }
    </style>
</head>
<body>
<h1>Welcome to your Todo List</h1>

<!--TODO: 2.1. Mostrar formulari //-->

<form action="tasks_add.php" method="POST">
    <label>Titol de la tasca
        <input type="text" name="title" value="<?=$data["title"]?>"/>
        </label>

    <label>
        Descripció de la tasca

        <textarea rows="10" cols="45" name="description" placeholder="Inserix cos del article"><?=$data["description"]?></textarea>
    </label>

    <label>
        Data de finalització
        <input type="date" name="due_date" value="<?=$data["due_date"]?>"/>

    </label>

    <label>
        Categoria
        <select name="codcat">
            <option value="disabled selected">(select an option)</option>
            <?php foreach ($categories as $categoria):?>
            <label for="<?=$categoria["name"]?>"><?=$categoria["name"]?></label>
            <option id="<?=$categoria["name"]?>" name="name" value="<?=$categoria["id"]?>">
            <?php endforeach;?>
        </select>
    </label>


    <input type="submit" value="Enviar"/>
</form>

<!--TODO: 2.3.1. Mostrar errors de validació //-->
<!--TODO: 2.3.3. Mostrar missatge de confirmació //-->

<hr>
<a href='index.php'>Home</a>
</body>
</html>