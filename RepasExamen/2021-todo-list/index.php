<?php
//Implementar la consulta
$pdo = new PDO("mysql:host=localhost;dbname=todo-list;charset=utf8" , "root","pancet");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>
<!DOCTYPE html>
<html>
<head>
    <title>Todo list</title>
</head>
<body>
<h1>Welcome to your Todo List</h1>
<!--TODO: Show posts -->
<ul>
    <?php foreach($tasks as $task) : ?>
        <li>
            <a href="tasks_show.php"><?=$task["title"]?></a> under <strong><?=$task["name"]?></strong>. Due date: <strong><?=$task["due_date"] ?></strong>.
        </li>
    <?php endforeach; ?>
</ul>
<p>Clic to <a href="tasks_add.php">add</a> a task.</p>
<hr>
<a href='index.php'>Home</a>
</body>
</html>