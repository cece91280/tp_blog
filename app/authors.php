<?php
require_once 'includes/dbconnect.php';

$sql = 'SELECT * FROM authors;';

$stmt = $pdo->query($sql);
$authors = $stmt->fetchAll();

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
    <header
    <h1>Liste des auteurs</h1>
    </header>
    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>prénom</th>
            <th>Email</th>
            <th>lien</th>
        </tr>
        </thead>
        <div>
            <tbody>
            <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?= $author['lastname']; ?></td>
                    <td><?= $author['firstname']; ?></td>
                    <td><?= $author['email']; ?></td>
                    <td><a href="delete_author.php?id=<?= $author['id'] ?>" onclick="return confirm('es-tu sûr de ' +
                     'vouloir' +
                     ' supprimer cet auteur ? ')">supprimer</a></td>
                    <td><a href="post_author.php?id=<?=$author['id']?>">liste d'articles</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </div>
    </table>
</main>
</body>
</html>
