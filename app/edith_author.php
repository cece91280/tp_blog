<?php
$id = $_GET['id'];
if (is_numeric($id)) {
    require_once 'includes/dbconnect.php';

    $sql = 'SELECT * FROM authors WHERE id = :id;';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $author = $stmt->fetch();

    if (!$author) {
        die('cette auteur existe pas.');
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
    <h1>Modifie un auteur</h1>
    <form action="traitment_edith_author.php" method="post">

        <label for="lastname">Nom :</label>
        <input type="text" name="lastname" id="lastname" value="<?= $author['lastname'] ?>">

        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" id="firstname" value="<?= $author['firstname'] ?>">

        <label for="email">email :</label>
        <input type="text" name="email" id="email" value="<?= $author['email'] ?>">

        <input type="hidden" name="id" value="<?= $author['id'] ?>">

        <button type="submit">Modifier</button>

    </form>
</main>
</body>
</html>
