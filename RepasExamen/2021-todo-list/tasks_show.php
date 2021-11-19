<?php
$id=0;
$errors=[];
// TODO: Obtenir l'id enviat pel query string
$idTemp=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
if (!empty($idTemp)) {
    $id = $idTemp;
}
// TODO: Implementar la consulta

$pdo = new PDO("mysql:host=localhost;dbname=todo-list;charset=utf8","user1","pancet");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * 
                            FROM task T INNER JOIN category C
                            ON t.category_id = C.id
                            WHERE T.id=:id");
$stmt->bindValue("id",$id);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$task=$stmt->fetch();
if (empty($task)){
    $errors[]="no s'ha trobat la tasca";
}


?>
<!DOCTYPE html>

<html>
<head>
    <title>Todo list</title>
</head>
<body>
<h1>Welcome to your Todo list</h1>
<?php if (empty($errors)):?>
<h2><?=$task["title"]?></h2>
<p><?=$task["description"]?></p>
<p>Publicat en la categoria <strong><?=$task["name"]?></strong>. Finalitza el <strong><?=$task["due_date"]?></strong></p>
<p><a href="tasks_edit.php?id=<?=$task["id"]?>">Edit</a> || <a href='tasks_delete.php?id=<?=$task["id"]?>'>Delete</a> </p>
<?php else:?>
<p><?=print_r($errors)?></p>
<?php endif;?>
<hr>
<a href='index.php'>Home</a>
</body>
</html>