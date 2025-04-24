<?php
$id = $_GET['id'];
if(is_numeric($id)) {
    require_once 'includes/dbconnect.php';

    $sql = "SELECT * FROM categories WHERE id= :id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch();

    if (!$category){
        die('cette catedory existe pas.');
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <h1>Modifie une catégorie</h1>
    <form action="traitment_edith_category.php" method="post">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">

        <label for="">Nom</label>
        <input type="text" name="name" value="<?= $category['name'] ?>">

        <label for="description"></label>
        <input type="text" name="description" id="description" value="<?= $category['description'] ?>">

        <button type="submit">Modifier</button>
    </form>
</main>
</body>
</html>
