<?php


// TODO: 1. Inicialitzar variables
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
<form action="tasks_add.php">
    <label>Titol de la tasca
        <input type="text" value=""/>
        </label>

    <label>
        Descripció de la tasca

        <textarea rows="10" cols="45" placeholder="Inserix cos del article"> </textarea>
    </label>

    <label>
        Data de finalització
        <input type="date" value=""/>

    </label>

    <label>
        Categoria
        <select name="codcat">
            <option value="disabled selected">(select an option)</option>

            <option value="ID CATEGORIA">NOM DE LA CATEGORIA</option>

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