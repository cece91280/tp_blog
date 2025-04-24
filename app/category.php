<?php
require_once 'includes/dbconnect.php';
$sql = 'SELECT * FROM categories;';
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des categories</title>
</head>

<body>
<main>
    <h1>Liste des categories</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Supprimer</th>
            <th>post</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo intval($category['id']) ?></td>
                <td><?php echo htmlspecialchars($category['name']) ?></td>
                <td><?php echo htmlspecialchars($category['description']) ?></td>
                <!-- Transmettre l'id de la categorie à supprimer -->
                <td><a href="./delete_category.php?id=<?php echo intval($category['id']) ?>">Supprimer</a></td>
                <td><a href="post_by_category.php?id=<?=$category['id']?>">Voir post</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>

</html>
